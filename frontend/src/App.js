import React, { useState, useEffect } from 'react';
import './App.css';

function App() {
  const [chickens, setChickens] = useState([]);
  const [newChicken, setNewChicken] = useState({ name: '', breed: '', birthdate: '' });
  const [editingChicken, setEditingChicken] = useState(null);

  useEffect(() => {
    fetch('http://localhost:3001/api/chickens')
      .then(response => response.json())
      .then(data => setChickens(data.data));
  }, []);

  const handleInputChange = (event) => {
    const { name, value } = event.target;
    if (editingChicken) {
      setEditingChicken({ ...editingChicken, [name]: value });
    } else {
      setNewChicken({ ...newChicken, [name]: value });
    }
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    if (editingChicken) {
      // Update existing chicken
      fetch(`http://localhost:3001/api/chickens/${editingChicken.id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(editingChicken),
      })
        .then(response => response.json())
        .then(data => {
          setChickens(chickens.map(c => c.id === editingChicken.id ? data.data : c));
          setEditingChicken(null);
        });
    } else {
      // Add new chicken
      fetch('http://localhost:3001/api/chickens', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(newChicken),
      })
        .then(response => response.json())
        .then(data => {
          setChickens([...chickens, data.data]);
          setNewChicken({ name: '', breed: '', birthdate: '' });
        });
    }
  };

  const handleDelete = (id) => {
    fetch(`http://localhost:3001/api/chickens/${id}`, {
      method: 'DELETE',
    })
      .then(() => {
        setChickens(chickens.filter(c => c.id !== id));
      });
  };

  const handleEdit = (chicken) => {
    setEditingChicken(chicken);
    setNewChicken({ name: '', breed: '', birthdate: '' });
  };

  const handleCancelEdit = () => {
    setEditingChicken(null);
  };


  return (
    <div className="App">
      <header className="App-header">
        <h1>Poultry Farm Management</h1>
      </header>
      <main>
        <h2>{editingChicken ? 'Edit Chicken' : 'Add a New Chicken'}</h2>
        <form onSubmit={handleSubmit}>
          <input
            type="text"
            name="name"
            placeholder="Name"
            value={editingChicken ? editingChicken.name : newChicken.name}
            onChange={handleInputChange}
            required
          />
          <input
            type="text"
            name="breed"
            placeholder="Breed"
            value={editingChicken ? editingChicken.breed : newChicken.breed}
            onChange={handleInputChange}
          />
          <input
            type="date"
            name="birthdate"
            placeholder="Birthdate"
            value={editingChicken ? editingChicken.birthdate : newChicken.birthdate}
            onChange={handleInputChange}
          />
          <button type="submit">{editingChicken ? 'Update Chicken' : 'Add Chicken'}</button>
          {editingChicken && <button type="button" onClick={handleCancelEdit}>Cancel</button>}
        </form>

        <h2>Chicken List</h2>
        <div className="chicken-list">
          {chickens.map(chicken => (
            <div key={chicken.id} className="chicken-item">
              <h3>{chicken.name}</h3>
              <p>Breed: {chicken.breed}</p>
              <p>Birthdate: {chicken.birthdate}</p>
              <button onClick={() => handleEdit(chicken)}>Edit</button>
              <button onClick={() => handleDelete(chicken.id)}>Delete</button>
            </div>
          ))}
        </div>
      </main>
    </div>
  );
}

export default App;
