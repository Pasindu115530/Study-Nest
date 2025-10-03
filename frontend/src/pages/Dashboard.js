import React from 'react';
import {
  Box,
  Container,
  Typography,
  Card,
  CardContent,
  Grid,
  Button,
  Paper
} from '@mui/material';
import {
  Upload,
  ViewList,
  Person,
  School
} from '@mui/icons-material';
import { useAuth } from '../contexts/AuthContext';
import { Link } from 'react-router-dom';

const Dashboard = () => {
  const { user, isAdmin } = useAuth();

  return (
    <Box
      sx={{
        minHeight: '100vh',
        background: 'linear-gradient(135deg, #0b0b0b 0%, #1a1a1a 100%)',
        py: 4
      }}
    >
      <Container maxWidth="lg">
        {/* Welcome Section */}
        <Paper
          elevation={24}
          sx={{
            p: 4,
            backgroundColor: 'rgba(255, 255, 255, 0.1)',
            backdropFilter: 'blur(10px)',
            border: '1px solid rgba(255, 255, 255, 0.2)',
            borderRadius: '20px',
            mb: 4
          }}
        >
          <Typography
            variant="h3"
            component="h1"
            sx={{
              color: 'white',
              mb: 2,
              fontWeight: 'bold'
            }}
          >
            Welcome back, {user?.fname}!
          </Typography>
          <Typography
            variant="h6"
            sx={{
              color: 'rgba(255, 255, 255, 0.8)'
            }}
          >
            {user?.department} • {user?.year} • {user?.role === 'admin' ? 'Administrator' : 'Student'}
          </Typography>
        </Paper>

        {/* Quick Actions */}
        <Typography
          variant="h4"
          component="h2"
          sx={{
            color: 'white',
            mb: 3,
            fontWeight: 'bold'
          }}
        >
          Quick Actions
        </Typography>

        <Grid container spacing={3} sx={{ mb: 4 }}>
          <Grid item xs={12} sm={6} md={3}>
            <Card
              component={Link}
              to="/view-notes"
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                textDecoration: 'none',
                '&:hover': {
                  transform: 'translateY(-5px)',
                  transition: 'transform 0.3s ease'
                }
              }}
            >
              <CardContent sx={{ textAlign: 'center', p: 3 }}>
                <ViewList sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                <Typography
                  variant="h6"
                  sx={{
                    color: 'white',
                    mb: 1,
                    fontWeight: 'bold'
                  }}
                >
                  View Notes
                </Typography>
                <Typography
                  variant="body2"
                  sx={{
                    color: 'rgba(255, 255, 255, 0.8)'
                  }}
                >
                  Browse and download lecture notes
                </Typography>
              </CardContent>
            </Card>
          </Grid>

          {isAdmin && (
            <Grid item xs={12} sm={6} md={3}>
              <Card
                component={Link}
                to="/upload-notes"
                sx={{
                  backgroundColor: 'rgba(255, 255, 255, 0.1)',
                  backdropFilter: 'blur(10px)',
                  border: '1px solid rgba(255, 255, 255, 0.2)',
                  borderRadius: '20px',
                  height: '100%',
                  textDecoration: 'none',
                  '&:hover': {
                    transform: 'translateY(-5px)',
                    transition: 'transform 0.3s ease'
                  }
                }}
              >
                <CardContent sx={{ textAlign: 'center', p: 3 }}>
                  <Upload sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                  <Typography
                    variant="h6"
                    sx={{
                      color: 'white',
                      mb: 1,
                      fontWeight: 'bold'
                    }}
                  >
                    Upload Notes
                  </Typography>
                  <Typography
                    variant="body2"
                    sx={{
                      color: 'rgba(255, 255, 255, 0.8)'
                    }}
                  >
                    Upload new lecture materials
                  </Typography>
                </CardContent>
              </Card>
            </Grid>
          )}

          <Grid item xs={12} sm={6} md={3}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                textDecoration: 'none',
                '&:hover': {
                  transform: 'translateY(-5px)',
                  transition: 'transform 0.3s ease'
                }
              }}
            >
              <CardContent sx={{ textAlign: 'center', p: 3 }}>
                <Person sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                <Typography
                  variant="h6"
                  sx={{
                    color: 'white',
                    mb: 1,
                    fontWeight: 'bold'
                  }}
                >
                  Profile
                </Typography>
                <Typography
                  variant="body2"
                  sx={{
                    color: 'rgba(255, 255, 255, 0.8)'
                  }}
                >
                  Manage your account
                </Typography>
              </CardContent>
            </Card>
          </Grid>

          <Grid item xs={12} sm={6} md={3}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                textDecoration: 'none',
                '&:hover': {
                  transform: 'translateY(-5px)',
                  transition: 'transform 0.3s ease'
                }
              }}
            >
              <CardContent sx={{ textAlign: 'center', p: 3 }}>
                <School sx={{ fontSize: 60, color: '#ff7200', mb: 2 }} />
                <Typography
                  variant="h6"
                  sx={{
                    color: 'white',
                    mb: 1,
                    fontWeight: 'bold'
                  }}
                >
                  Subjects
                </Typography>
                <Typography
                  variant="body2"
                  sx={{
                    color: 'rgba(255, 255, 255, 0.8)'
                  }}
                >
                  View available subjects
                </Typography>
              </CardContent>
            </Card>
          </Grid>
        </Grid>

        {/* Recent Activity */}
        <Paper
          elevation={24}
          sx={{
            p: 4,
            backgroundColor: 'rgba(255, 255, 255, 0.1)',
            backdropFilter: 'blur(10px)',
            border: '1px solid rgba(255, 255, 255, 0.2)',
            borderRadius: '20px'
          }}
        >
          <Typography
            variant="h4"
            component="h2"
            sx={{
              color: 'white',
              mb: 3,
              fontWeight: 'bold'
            }}
          >
            Recent Activity
          </Typography>
          <Typography
            variant="body1"
            sx={{
              color: 'rgba(255, 255, 255, 0.8)'
            }}
          >
            No recent activity to display.
          </Typography>
        </Paper>
      </Container>
    </Box>
  );
};

export default Dashboard;
