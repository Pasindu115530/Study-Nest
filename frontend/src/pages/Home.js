import React from 'react';
import { Link } from 'react-router-dom';
import {
  Box,
  Container,
  Typography,
  Button,
  Grid,
  Card,
  CardContent,
  CardMedia,
  Paper
} from '@mui/material';
import {
  School,
  Book,
  Group,
  Security
} from '@mui/icons-material';

const Home = () => {
  return (
    <Box>
      {/* Hero Section */}
      <Box
        sx={{
          background: 'linear-gradient(135deg, #0b0b0b 0%, #1a1a1a 100%)',
          minHeight: '100vh',
          display: 'flex',
          alignItems: 'center',
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

        <Container maxWidth="lg">
          <Grid container spacing={4} alignItems="center">
            <Grid item xs={12} md={6}>
              <Typography
                variant="h1"
                component="h1"
                sx={{
                  fontSize: { xs: '2.5rem', md: '4rem' },
                  fontWeight: 'bold',
                  color: 'white',
                  mb: 2,
                  lineHeight: 1.2
                }}
              >
                Welcome to <br />
                <Box component="span" sx={{ color: '#ff7200' }}>
                  Study Nest
                </Box>
              </Typography>
              
              <Typography
                variant="h4"
                sx={{
                  color: '#f3a05d',
                  mb: 3,
                  fontWeight: 300
                }}
              >
                Find | Learn | Grow
              </Typography>

              <Typography
                variant="h6"
                sx={{
                  color: 'rgba(255, 255, 255, 0.8)',
                  mb: 4,
                  lineHeight: 1.6,
                  maxWidth: '500px'
                }}
              >
                At StudyNest, we believe every learner deserves a sanctuary of knowledge. 
                Dive into our carefully curated collection of textbooks, study guides, 
                and expert resources.
              </Typography>

              <Box sx={{ display: 'flex', gap: 2, flexWrap: 'wrap' }}>
                <Button
                  variant="contained"
                  size="large"
                  component={Link}
                  to="/login"
                  sx={{
                    backgroundColor: '#ff7200',
                    '&:hover': { backgroundColor: '#e65a00' },
                    px: 4,
                    py: 1.5
                  }}
                >
                  LOG IN
                </Button>
                <Button
                  variant="outlined"
                  size="large"
                  component={Link}
                  to="/signup"
                  sx={{
                    borderColor: '#ff7200',
                    color: '#ff7200',
                    '&:hover': {
                      borderColor: '#e65a00',
                      backgroundColor: 'rgba(255, 114, 0, 0.1)'
                    },
                    px: 4,
                    py: 1.5
                  }}
                >
                  SIGN UP
                </Button>
              </Box>
            </Grid>

            <Grid item xs={12} md={6}>
              <Box
                sx={{
                  display: 'flex',
                  justifyContent: 'center',
                  alignItems: 'center'
                }}
              >
                <img
                  src="/api/placeholder/600/400"
                  alt="Study Nest"
                  style={{
                    width: '100%',
                    maxWidth: '600px',
                    height: 'auto',
                    borderRadius: '20px'
                  }}
                />
              </Box>
            </Grid>
          </Grid>
        </Container>
      </Box>

      {/* Features Section */}
      <Box sx={{ py: 8, backgroundColor: '#0b0b0b' }}>
        <Container maxWidth="lg">
          <Typography
            variant="h3"
            component="h2"
            textAlign="center"
            sx={{
              color: 'white',
              mb: 6,
              fontWeight: 'bold'
            }}
          >
            Why Choose StudyNest?
          </Typography>

          <Grid container spacing={4}>
            <Grid item xs={12} md={3}>
              <Card
                sx={{
                  backgroundColor: 'rgba(255, 255, 255, 0.1)',
                  backdropFilter: 'blur(10px)',
                  border: '1px solid rgba(255, 255, 255, 0.2)',
                  height: '100%',
                  '&:hover': {
                    transform: 'translateY(-5px)',
                    transition: 'transform 0.3s ease'
                  }
                }}
              >
                <CardContent sx={{ textAlign: 'center', p: 3 }}>
                  <School sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                  <Typography variant="h5" sx={{ color: 'white', mb: 2, fontWeight: 'bold' }}>
                    Centralized Resources
                  </Typography>
                  <Typography variant="body1" sx={{ color: 'rgba(255, 255, 255, 0.8)' }}>
                    All your study materials in one place, organized by department and semester.
                  </Typography>
                </CardContent>
              </Card>
            </Grid>

            <Grid item xs={12} md={3}>
              <Card
                sx={{
                  backgroundColor: 'rgba(255, 255, 255, 0.1)',
                  backdropFilter: 'blur(10px)',
                  border: '1px solid rgba(255, 255, 255, 0.2)',
                  height: '100%',
                  '&:hover': {
                    transform: 'translateY(-5px)',
                    transition: 'transform 0.3s ease'
                  }
                }}
              >
                <CardContent sx={{ textAlign: 'center', p: 3 }}>
                  <Book sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                  <Typography variant="h5" sx={{ color: 'white', mb: 2, fontWeight: 'bold' }}>
                    Easy Access
                  </Typography>
                  <Typography variant="body1" sx={{ color: 'rgba(255, 255, 255, 0.8)' }}>
                    Quick search and download of lecture notes, past papers, and presentations.
                  </Typography>
                </CardContent>
              </Card>
            </Grid>

            <Grid item xs={12} md={3}>
              <Card
                sx={{
                  backgroundColor: 'rgba(255, 255, 255, 0.1)',
                  backdropFilter: 'blur(10px)',
                  border: '1px solid rgba(255, 255, 255, 0.2)',
                  height: '100%',
                  '&:hover': {
                    transform: 'translateY(-5px)',
                    transition: 'transform 0.3s ease'
                  }
                }}
              >
                <CardContent sx={{ textAlign: 'center', p: 3 }}>
                  <Group sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                  <Typography variant="h5" sx={{ color: 'white', mb: 2, fontWeight: 'bold' }}>
                    Community Driven
                  </Typography>
                  <Typography variant="body1" sx={{ color: 'rgba(255, 255, 255, 0.8)' }}>
                    Share and discover resources with fellow students and educators.
                  </Typography>
                </CardContent>
              </Card>
            </Grid>

            <Grid item xs={12} md={3}>
              <Card
                sx={{
                  backgroundColor: 'rgba(255, 255, 255, 0.1)',
                  backdropFilter: 'blur(10px)',
                  border: '1px solid rgba(255, 255, 255, 0.2)',
                  height: '100%',
                  '&:hover': {
                    transform: 'translateY(-5px)',
                    transition: 'transform 0.3s ease'
                  }
                }}
              >
                <CardContent sx={{ textAlign: 'center', p: 3 }}>
                  <Security sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                  <Typography variant="h5" sx={{ color: 'white', mb: 2, fontWeight: 'bold' }}>
                    Secure Platform
                  </Typography>
                  <Typography variant="body1" sx={{ color: 'rgba(255, 255, 255, 0.8)' }}>
                    Your data is safe with our secure authentication and file management.
                  </Typography>
                </CardContent>
              </Card>
            </Grid>
          </Grid>
        </Container>
      </Box>
    </Box>
  );
};

export default Home;
