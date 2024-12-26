/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './src/**/*.{html,js,php}',
      './public/**/*.{html,js,php}',
      './admin/**/*.{html,js,php}',
      './includes/**/*.{html,js,php}',
  ],
  prefix: 'diz-',
  theme: {
    extend: {},
  },
  plugins: [],
}

