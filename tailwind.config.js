/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/**/*.js",
  ],
  theme: {
    extend: {
      borderRadius: {
        4: "0.25rem",
      },
    },
  },
  plugins: [],
}

