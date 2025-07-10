document.addEventListener('DOMContentLoaded', () => {
  const navLinks = document.querySelectorAll('.nav-link[data-section]');
  const sections = document.querySelectorAll('#content-panel > section');

  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();

      // Remove 'active' class from all nav links
      navLinks.forEach(lnk => lnk.classList.remove('active'));

      // Add 'active' to clicked nav link
      link.classList.add('active');

      // Hide all sections
      sections.forEach(sec => sec.style.display = 'none');

      // Show the section corresponding to clicked nav link
      const target = link.getAttribute('data-section');
      const targetSection = document.getElementById(target);
      if(targetSection) {
        targetSection.style.display = 'block';
      }
    });
  });
});