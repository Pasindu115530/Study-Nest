const mongoose = require('mongoose');

const subjectSchema = new mongoose.Schema({
  subject_name: {
    type: String,
    required: [true, 'Subject name is required'],
    trim: true
  },
  semester: {
    type: String,
    required: [true, 'Semester is required'],
    enum: ['1', '2']
  },
  year: {
    type: String,
    required: [true, 'Year is required'],
    enum: ['1', '2', '3', '4']
  },
  department: {
    type: String,
    required: [true, 'Department is required'],
    enum: ['Computer Science', 'Software Engineering', 'Information Systems']
  },
  upload_date: {
    type: Date,
    default: Date.now
  }
}, {
  timestamps: true
});

module.exports = mongoose.model('Subject', subjectSchema);
