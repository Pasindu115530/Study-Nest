const express = require('express');
const Subject = require('../models/Subject');
const { auth, adminAuth } = require('../middleware/auth');

const router = express.Router();

// Get all subjects
router.get('/', async (req, res) => {
  try {
    const { department, year, semester } = req.query;
    let filter = {};

    if (department) filter.department = department;
    if (year) filter.year = year;
    if (semester) filter.semester = semester;

    const subjects = await Subject.find(filter).sort({ subject_name: 1 });
    res.json(subjects);
  } catch (error) {
    console.error('Get subjects error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Get subject by ID
router.get('/:id', async (req, res) => {
  try {
    const subject = await Subject.findById(req.params.id);
    if (!subject) {
      return res.status(404).json({ message: 'Subject not found' });
    }
    res.json(subject);
  } catch (error) {
    console.error('Get subject error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Create subject (admin only)
router.post('/', adminAuth, async (req, res) => {
  try {
    const { subject_name, semester, year, department } = req.body;

    const subject = new Subject({
      subject_name,
      semester,
      year,
      department
    });

    await subject.save();
    res.status(201).json({ message: 'Subject created successfully', subject });
  } catch (error) {
    console.error('Create subject error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Update subject (admin only)
router.put('/:id', adminAuth, async (req, res) => {
  try {
    const { subject_name, semester, year, department } = req.body;

    const subject = await Subject.findByIdAndUpdate(
      req.params.id,
      { subject_name, semester, year, department },
      { new: true, runValidators: true }
    );

    if (!subject) {
      return res.status(404).json({ message: 'Subject not found' });
    }

    res.json({ message: 'Subject updated successfully', subject });
  } catch (error) {
    console.error('Update subject error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Delete subject (admin only)
router.delete('/:id', adminAuth, async (req, res) => {
  try {
    const subject = await Subject.findByIdAndDelete(req.params.id);
    if (!subject) {
      return res.status(404).json({ message: 'Subject not found' });
    }
    res.json({ message: 'Subject deleted successfully' });
  } catch (error) {
    console.error('Delete subject error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

module.exports = router;
