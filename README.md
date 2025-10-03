# StudyNest - MERN Stack Application

A modern, full-stack web application for managing and sharing academic resources. StudyNest provides a centralized platform for students and educators to upload, organize, and access lecture notes, study materials, and course resources.

## 🚀 Features

### For Students
- **User Authentication**: Secure login and registration system
- **Browse Resources**: Search and filter lecture notes by department, year, and semester
- **Download Materials**: Easy access to PDFs, presentations, and study guides
- **Personal Dashboard**: Track your academic progress and access history

### For Administrators
- **Content Management**: Upload and organize lecture materials
- **User Management**: Manage student accounts and permissions
- **Analytics**: Track resource usage and user engagement
- **Bulk Operations**: Efficiently manage large amounts of academic content

### General Features
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices
- **Modern UI**: Beautiful, intuitive interface with dark theme
- **Search & Filter**: Advanced filtering options for finding specific resources
- **Secure File Handling**: Safe upload and download of academic materials
- **Real-time Updates**: Instant updates when new content is added

## 🛠️ Technology Stack

### Frontend
- **React 18**: Modern JavaScript library for building user interfaces
- **Material-UI (MUI)**: Comprehensive React component library
- **React Router**: Client-side routing for single-page application
- **Axios**: HTTP client for API communication
- **Context API**: State management for authentication and user data

### Backend
- **Node.js**: JavaScript runtime environment
- **Express.js**: Web application framework for Node.js
- **MongoDB**: NoSQL database for storing application data
- **Mongoose**: MongoDB object modeling for Node.js
- **JWT**: JSON Web Tokens for secure authentication
- **Multer**: Middleware for handling multipart/form-data (file uploads)
- **bcryptjs**: Password hashing for security

### Database Schema
- **Users**: Student and admin account information
- **Subjects**: Course and subject catalog
- **Lecture Notes**: File metadata and binary data storage

## 📋 Prerequisites

Before running this application, make sure you have the following installed:

- **Node.js** (v14 or higher)
- **MongoDB** (v4.4 or higher)
- **npm** or **yarn** package manager

## 🚀 Installation & Setup

### 1. Clone the Repository
```bash
git clone <repository-url>
cd studynest-mern
```

### 2. Backend Setup
```bash
cd backend
npm install
```

Create a `.env` file in the backend directory:
```env
PORT=5000
MONGODB_URI=mongodb://localhost:27017/studynest
JWT_SECRET=your_jwt_secret_key_here
JWT_EXPIRE=7d
```

### 3. Frontend Setup
```bash
cd ../frontend
npm install
```

### 4. Database Setup
Make sure MongoDB is running on your system:
```bash
# Start MongoDB service
mongod
```

### 5. Running the Application

#### Start the Backend Server
```bash
cd backend
npm run dev
```
The backend server will start on `http://localhost:5000`

#### Start the Frontend Development Server
```bash
cd frontend
npm start
```
The frontend will start on `http://localhost:3000`

## 📁 Project Structure

```
studynest-mern/
├── backend/
│   ├── models/           # Mongoose schemas
│   ├── routes/           # API route handlers
│   ├── middleware/       # Custom middleware functions
│   ├── config.env        # Environment variables
│   └── server.js         # Main server file
├── frontend/
│   ├── public/           # Static assets
│   ├── src/
│   │   ├── components/   # Reusable React components
│   │   ├── pages/        # Page components
│   │   ├── contexts/     # React Context providers
│   │   ├── services/     # API service functions
│   │   └── utils/        # Utility functions
│   └── package.json
└── README.md
```

## 🔧 API Endpoints

### Authentication
- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User login
- `GET /api/auth/me` - Get current user

### Users
- `GET /api/users` - Get all users (admin only)
- `GET /api/users/:id` - Get user by ID
- `PUT /api/users/:id` - Update user profile
- `DELETE /api/users/:id` - Delete user (admin only)

### Subjects
- `GET /api/subjects` - Get all subjects
- `GET /api/subjects/:id` - Get subject by ID
- `POST /api/subjects` - Create subject (admin only)
- `PUT /api/subjects/:id` - Update subject (admin only)
- `DELETE /api/subjects/:id` - Delete subject (admin only)

### Lecture Notes
- `GET /api/lecture-notes` - Get all lecture notes
- `GET /api/lecture-notes/:id` - Get lecture note by ID
- `GET /api/lecture-notes/:id/download` - Download lecture note
- `POST /api/lecture-notes` - Upload lecture note (admin only)
- `PUT /api/lecture-notes/:id` - Update lecture note (admin only)
- `DELETE /api/lecture-notes/:id` - Delete lecture note (admin only)

## 🎨 UI Components

### Pages
- **Home**: Landing page with features and call-to-action
- **About**: Information about the platform and its objectives
- **Services**: Overview of available services
- **Contact**: Contact form and information
- **Login/Signup**: Authentication pages
- **Dashboard**: User dashboard with quick actions
- **Upload Notes**: Admin interface for uploading materials
- **View Notes**: Browse and download lecture notes

### Key Features
- **Responsive Design**: Mobile-first approach with Material-UI
- **Dark Theme**: Modern dark theme with orange accent colors
- **Glassmorphism**: Frosted glass effects for modern aesthetics
- **Interactive Elements**: Hover effects and smooth transitions
- **Form Validation**: Client-side and server-side validation
- **Error Handling**: User-friendly error messages and loading states

## 🔒 Security Features

- **Password Hashing**: bcryptjs for secure password storage
- **JWT Authentication**: Secure token-based authentication
- **Input Validation**: Server-side validation for all inputs
- **File Type Validation**: Only PDF files allowed for uploads
- **Role-based Access**: Admin and user role permissions
- **CORS Configuration**: Cross-origin resource sharing setup

## 🚀 Deployment

### Backend Deployment
1. Set up MongoDB Atlas or use a cloud MongoDB service
2. Update the `MONGODB_URI` in your environment variables
3. Deploy to platforms like Heroku, Railway, or DigitalOcean
4. Set up environment variables in your hosting platform

### Frontend Deployment
1. Build the production version: `npm run build`
2. Deploy to platforms like Netlify, Vercel, or GitHub Pages
3. Update API endpoints to point to your deployed backend

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👥 Team

Developed by the Web Technologies Group for StudyNest platform.

## 📞 Support

For support and questions, please contact us at:
- Email: info@studynest.com
- Phone: +1 (555) 123-4567

---

**StudyNest** - Empowering learners with seamless access to academic resources.
