import React from 'react';
import {
  Box,
  Container,
  Typography,
  Card,
  CardContent,
  Grid,
  Paper
} from '@mui/material';
import {
  ManageAccounts,
  Quiz,
  TrackChanges
} from '@mui/icons-material';

const Services = () => {
  return (
    <Box
      sx={{
        minHeight: '100vh',
        background: 'linear-gradient(135deg, #0b0b0b 0%, #1a1a1a 100%)',
        position: 'relative',
        overflow: 'hidden'
      }}
    >
      {/* Background Elements */}
      <Box
        sx={{
          position: 'absolute',
          width: '600px',
          height: '500px',
          background: 'linear-gradient(to right, #ff7200 50%, #f3a05d 80%, #ff7200 100%)',
          borderRadius: '50%',
          bottom: '282px',
          left: '-70px',
          filter: 'blur(25px)',
          opacity: 0.3
        }}
      />
      <Box
        sx={{
          width: '150px',
          height: '150px',
          background: 'linear-gradient(to right, #ff7200 50%, #f5b641 100%)',
          borderRadius: '50%',
          position: 'absolute',
          right: '100px',
          top: '430px',
          filter: 'blur(25px)',
          opacity: 0.3
        }}
      />

      <Container maxWidth="lg" sx={{ py: 8, position: 'relative', zIndex: 1 }}>
        {/* Hero Section */}
        <Box sx={{ textAlign: 'center', mb: 8 }}>
          <Typography
            variant="h2"
            component="h1"
            sx={{
              color: 'white',
              mb: 3,
              fontWeight: 'bold'
            }}
          >
            Our Services
          </Typography>
          <Typography
            variant="h5"
            sx={{
              color: 'rgba(255, 255, 255, 0.8)',
              maxWidth: '600px',
              mx: 'auto'
            }}
          >
            Empowering learners with seamless access to courses, resources, and support for a better educational experience.
          </Typography>
        </Box>

        {/* Services Grid */}
        <Grid container spacing={4}>
          <Grid item xs={12} md={4}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                p: 3,
                '&:hover': {
                  transform: 'translateY(-5px)',
                  transition: 'transform 0.3s ease'
                }
              }}
            >
              <CardContent sx={{ textAlign: 'center' }}>
                <ManageAccounts sx={{ fontSize: 80, color: '#ff7200', mb: 3 }} />
                <Typography
                  variant="h4"
                  sx={{
                    color: 'white',
                    mb: 3,
                    fontWeight: 'bold'
                  }}
                >
                  Course Management
                </Typography>
                <Typography
                  variant="body1"
                  sx={{
                    color: 'rgba(255, 255, 255, 0.8)',
                    lineHeight: 1.6
                  }}
                >
                  Study-Nest allows educators to create, organize, and manage all your course materials in one place. 
                  Share lecture notes, videos, and updates with your students easily.
                </Typography>
              </CardContent>
            </Card>
          </Grid>

          <Grid item xs={12} md={4}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                p: 3,
                '&:hover': {
                  transform: 'translateY(-5px)',
                  transition: 'transform 0.3s ease'
                }
              }}
            >
              <CardContent sx={{ textAlign: 'center' }}>
                <Quiz sx={{ fontSize: 80, color: '#ff7200', mb: 3 }} />
                <Typography
                  variant="h4"
                  sx={{
                    color: 'white',
                    mb: 3,
                    fontWeight: 'bold'
                  }}
                >
                  Online Assessments
                </Typography>
                <Typography
                  variant="body1"
                  sx={{
                    color: 'rgba(255, 255, 255, 0.8)',
                    lineHeight: 1.6
                  }}
                >
                  Educators can design quizzes, timed exams, and interactive assessments with automatic grading, 
                  feedback, and randomization features.
                </Typography>
              </CardContent>
            </Card>
          </Grid>

          <Grid item xs={12} md={4}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                p: 3,
                '&:hover': {
                  transform: 'translateY(-5px)',
                  transition: 'transform 0.3s ease'
                }
              }}
            >
              <CardContent sx={{ textAlign: 'center' }}>
                <TrackChanges sx={{ fontSize: 80, color: '#ff7200', mb: 3 }} />
                <Typography
                  variant="h4"
                  sx={{
                    color: 'white',
                    mb: 3,
                    fontWeight: 'bold'
                  }}
                >
                  Student Tracking
                </Typography>
                <Typography
                  variant="body1"
                  sx={{
                    color: 'rgba(255, 255, 255, 0.8)',
                    lineHeight: 1.6
                  }}
                >
                  Monitor student activity and performance in real time. With comprehensive tracking tools, 
                  instructors can view attendance, participation, assignment submissions, and quiz scores.
                </Typography>
              </CardContent>
            </Card>
          </Grid>
        </Grid>

        {/* Footer */}
        <Box sx={{ textAlign: 'center', mt: 8 }}>
          <Typography
            variant="body1"
            sx={{
              color: 'rgba(255, 255, 255, 0.6)'
            }}
          >
            &copy; 2025 Study-Nest Site. All rights reserved.
          </Typography>
        </Box>
      </Container>
    </Box>
  );
};

export default Services;
