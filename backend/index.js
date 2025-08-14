const express = require('express');
const sqlite3 = require('sqlite3').verbose();
const cors = require('cors');

const app = express();
const port = 3001;

app.use(cors());
app.use(express.json());

// Set up the database
const db = new sqlite3.Database('./database.db', (err) => {
  if (err) {
    console.error(err.message);
  }
  console.log('Connected to the SQLite database.');
});

// Create the chickens table if it doesn't exist
db.run(`
  CREATE TABLE IF NOT EXISTS chickens (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    breed TEXT,
    birthdate TEXT
  )
`);

// API Endpoints

// Get all chickens
app.get('/api/chickens', (req, res) => {
  const sql = 'SELECT * FROM chickens';
  db.all(sql, [], (err, rows) => {
    if (err) {
      res.status(500).json({ error: err.message });
      return;
    }
    res.json({
      message: 'success',
      data: rows,
    });
  });
});

// Get a single chicken by id
app.get('/api/chickens/:id', (req, res) => {
  const sql = 'SELECT * FROM chickens WHERE id = ?';
  const params = [req.params.id];
  db.get(sql, params, (err, row) => {
    if (err) {
      res.status(500).json({ error: err.message });
      return;
    }
    res.json({
      message: 'success',
      data: row,
    });
  });
});

// Create a new chicken
app.post('/api/chickens', (req, res) => {
  const { name, breed, birthdate } = req.body;
  const sql = 'INSERT INTO chickens (name, breed, birthdate) VALUES (?, ?, ?)';
  const params = [name, breed, birthdate];
  db.run(sql, params, function (err) {
    if (err) {
      res.status(500).json({ error: err.message });
      return;
    }
    res.json({
      message: 'success',
      data: { id: this.lastID, ...req.body },
    });
  });
});

// Update a chicken
app.put('/api/chickens/:id', (req, res) => {
  const { name, breed, birthdate } = req.body;
  const sql = 'UPDATE chickens SET name = ?, breed = ?, birthdate = ? WHERE id = ?';
  const params = [name, breed, birthdate, req.params.id];
  db.run(sql, params, function (err) {
    if (err) {
      res.status(500).json({ error: err.message });
      return;
    }
    res.json({
      message: 'success',
      data: { id: req.params.id, ...req.body },
    });
  });
});

// Delete a chicken
app.delete('/api/chickens/:id', (req, res) => {
  const sql = 'DELETE FROM chickens WHERE id = ?';
  const params = [req.params.id];
  db.run(sql, params, function (err) {
    if (err) {
      res.status(500).json({ error: err.message });
      return;
    }
    res.json({ message: 'deleted', changes: this.changes });
  });
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
