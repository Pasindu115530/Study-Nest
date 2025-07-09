const button1 = document.querySelector('.button-creative1');
const glow1 = button1.querySelector('::before');

button1.addEventListener('mousemove', (e) => {
  const rect = button1.getBoundingClientRect();
  const x = e.clientX - rect.left;
  const y = e.clientY - rect.top;

  button1.style.setProperty('--x', `${x}px`);
  button1.style.setProperty('--y', `${y}px`);
});


const button2 = document.querySelector('.button-creative2');
const glow2 = button2.querySelector('::before');

button2.addEventListener('mousemove', (e) => {
  const rect = button2.getBoundingClientRect();
  const x = e.clientX - rect.left;
  const y = e.clientY - rect.top;

  button2.style.setProperty('--x', `${x}px`);
  button2.style.setProperty('--y', `${y}px`);
});