/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/**/*.js",
  ],
  theme: {
    extend: {
      spacing: {
        "3.25": "0.813rem",
      },
      borderWidth: {
        "6": "6px",
      },
      borderRadius: {
        4: "0.25rem",
      },
    },
  },
  plugins: [],
}
