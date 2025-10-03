import React from 'react';
import {
  Box,
  Container,
  Typography,
  Card,
  CardContent,
  Grid,
  List,
  ListItem,
  ListItemIcon,
  ListItemText
} from '@mui/material';
import {
  CheckCircle,
  School,
  Security,
  Speed,
  Group,
  CloudUpload
} from '@mui/icons-material';

const About = () => {
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
        {/* Welcome Card */}
        <Card
          sx={{
            backgroundColor: 'rgba(255, 255, 255, 0.1)',
            backdropFilter: 'blur(10px)',
            border: '1px solid rgba(255, 255, 255, 0.2)',
            borderRadius: '20px',
            mb: 6,
            p: 4
          }}
        >
          <CardContent>
            <Typography
              variant="h3"
              component="h1"
              sx={{
                color: 'white',
                mb: 3,
                fontWeight: 'bold',
                textAlign: 'center'
              }}
            >
              Welcome to Study Nest
            </Typography>
            <Typography
              variant="h6"
              sx={{
                color: 'rgba(255, 255, 255, 0.8)',
                lineHeight: 1.6,
                textAlign: 'center',
                maxWidth: '800px',
                mx: 'auto'
              }}
            >
              <strong>Study Nest</strong> is a centralized online platform that simplifies student access to university study materials. 
              It allows students from various departments to find lecture notes, past papers, presentations, and course-related documents — 
              all sorted by semester and subject. With an intuitive interface and robust organization, Study Nest helps students stay 
              prepared, reduce stress, and perform better.
            </Typography>
          </CardContent>
        </Card>

        {/* Features Grid */}
        <Grid container spacing={4}>
          <Grid item xs={12} md={6}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                p: 3
              }}
            >
              <CardContent>
                <Typography
                  variant="h4"
                  sx={{
                    color: '#ff7200',
                    mb: 3,
                    fontWeight: 'bold'
                  }}
                >
                  Our Objectives
                </Typography>
                <List>
                  <ListItem>
                    <ListItemIcon>
                      <CheckCircle sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Centralize and preserve academic resources"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <CheckCircle sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Provide secure and easy access to study content"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <CheckCircle sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Enable smooth navigation by department and semester"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <CheckCircle sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Support long-term academic planning and revisions"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                </List>
              </CardContent>
            </Card>
          </Grid>

          <Grid item xs={12} md={6}>
            <Card
              sx={{
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)',
                border: '1px solid rgba(255, 255, 255, 0.2)',
                borderRadius: '20px',
                height: '100%',
                p: 3
              }}
            >
              <CardContent>
                <Typography
                  variant="h4"
                  sx={{
                    color: '#ff7200',
                    mb: 3,
                    fontWeight: 'bold'
                  }}
                >
                  Key Features
                </Typography>
                <List>
                  <ListItem>
                    <ListItemIcon>
                      <Security sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="User authentication with student/admin roles"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <CloudUpload sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Downloadable PDFs, slides, and past papers"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <School sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Department-wise and semester-wise filtering"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <Speed sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Mobile responsive user interface"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                  <ListItem>
                    <ListItemIcon>
                      <Group sx={{ color: '#ff7200' }} />
                    </ListItemIcon>
                    <ListItemText
                      primary="Admin tools for content upload and updates"
                      sx={{ color: 'rgba(255, 255, 255, 0.8)' }}
                    />
                  </ListItem>
                </List>
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
            &copy; 2025 Study Nest | Developed by Web Technologies Group
          </Typography>
        </Box>
      </Container>
    </Box>
  );
};

export default About;
