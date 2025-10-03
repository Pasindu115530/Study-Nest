const express = require('express');
const multer = require('multer');
const LectureNote = require('../models/LectureNote');
const { auth, adminAuth } = require('../middleware/auth');

const router = express.Router();

// Configure multer for file uploads
const storage = multer.memoryStorage();
const upload = multer({
  storage: storage,
  limits: {
    fileSize: 10 * 1024 * 1024, // 10MB limit
  },
  fileFilter: (req, file, cb) => {
    if (file.mimetype === 'application/pdf') {
      cb(null, true);
    } else {
      cb(new Error('Only PDF files are allowed'), false);
    }
  }
});

// Get all lecture notes
router.get('/', async (req, res) => {
  try {
    const { department, year, semester, module } = req.query;
    let filter = {};

    if (department) filter.department = department;
    if (year) filter.year = year;
    if (semester) filter.semester = semester;
    if (module) filter.module = { $regex: module, $options: 'i' };

    const lectureNotes = await LectureNote.find(filter)
      .populate('uploadedBy', 'fname lname username')
      .sort({ upload_date: -1 });

    res.json(lectureNotes);
  } catch (error) {
    console.error('Get lecture notes error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Get lecture note by ID
router.get('/:id', async (req, res) => {
  try {
    const lectureNote = await LectureNote.findById(req.params.id)
      .populate('uploadedBy', 'fname lname username');

    if (!lectureNote) {
      return res.status(404).json({ message: 'Lecture note not found' });
    }

    res.json(lectureNote);
  } catch (error) {
    console.error('Get lecture note error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Download lecture note
router.get('/:id/download', async (req, res) => {
  try {
    const lectureNote = await LectureNote.findById(req.params.id);

    if (!lectureNote) {
      return res.status(404).json({ message: 'Lecture note not found' });
    }

    res.setHeader('Content-Type', lectureNote.mimeType);
    res.setHeader('Content-Disposition', `attachment; filename="${lectureNote.filename}"`);
    res.setHeader('Content-Length', lectureNote.fileSize);

    res.send(lectureNote.filedata);
  } catch (error) {
    console.error('Download lecture note error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Upload lecture note (admin only)
router.post('/', adminAuth, upload.single('file'), async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({ message: 'No file uploaded' });
    }

    const { module, year, semester, department } = req.body;

    const lectureNote = new LectureNote({
      filename: req.file.originalname,
      module,
      filedata: req.file.buffer,
      year: parseInt(year),
      semester,
      department,
      uploadedBy: req.user._id,
      fileSize: req.file.size,
      mimeType: req.file.mimetype
    });

    await lectureNote.save();
    res.status(201).json({ message: 'Lecture note uploaded successfully', lectureNote });
  } catch (error) {
    console.error('Upload lecture note error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Update lecture note (admin only)
router.put('/:id', adminAuth, async (req, res) => {
  try {
    const { module, year, semester, department } = req.body;

    const lectureNote = await LectureNote.findByIdAndUpdate(
      req.params.id,
      { module, year, semester, department },
      { new: true, runValidators: true }
    );

    if (!lectureNote) {
      return res.status(404).json({ message: 'Lecture note not found' });
    }

    res.json({ message: 'Lecture note updated successfully', lectureNote });
  } catch (error) {
    console.error('Update lecture note error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

// Delete lecture note (admin only)
router.delete('/:id', adminAuth, async (req, res) => {
  try {
    const lectureNote = await LectureNote.findByIdAndDelete(req.params.id);
    if (!lectureNote) {
      return res.status(404).json({ message: 'Lecture note not found' });
    }
    res.json({ message: 'Lecture note deleted successfully' });
  } catch (error) {
    console.error('Delete lecture note error:', error);
    res.status(500).json({ message: 'Server error' });
  }
});

module.exports = router;
