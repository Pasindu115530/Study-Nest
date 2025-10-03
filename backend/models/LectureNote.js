const mongoose = require('mongoose');

const lectureNoteSchema = new mongoose.Schema({
  filename: {
    type: String,
    required: [true, 'Filename is required'],
    trim: true
  },
  module: {
    type: String,
    required: [true, 'Module name is required'],
    trim: true
  },
  filedata: {
    type: Buffer,
    required: [true, 'File data is required']
  },
  upload_date: {
    type: Date,
    default: Date.now
  },
  year: {
    type: Number,
    required: [true, 'Year is required'],
    min: 1,
    max: 4
  },
  semester: {
    type: String,
    required: [true, 'Semester is required'],
    enum: ['1', '2']
  },
  department: {
    type: String,
    required: [true, 'Department is required'],
    enum: ['Computer Science', 'Software Engineering', 'Information Systems']
  },
  uploadedBy: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
    required: true
  },
  fileSize: {
    type: Number,
    required: true
  },
  mimeType: {
    type: String,
    default: 'application/pdf'
  }
}, {
  timestamps: true
});

module.exports = mongoose.model('LectureNote', lectureNoteSchema);
