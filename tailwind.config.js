/** @type {import('tailwindcss').Config} */
export default {
  content: [],
  theme: {
    extend: {},
  },
  plugins: [],
}

module.exports = {
  content: [
    './resources/views/**/*.blade.php', // Inclua os arquivos Blade
    './resources/js/**/*.js', // Inclua os arquivos JavaScript
  ],
  theme: {
    extend: {},
    screens: {
      sm: '640px',  // Pequeno (Celulares)
      md: '768px',  // Médio (Tablets)
      lg: '1024px', // Grande (Laptops)
      xl: '1280px', // Extra Grande (Monitores)
    },
  },
  plugins: [],
}
