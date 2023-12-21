/** @type {import('tailwindcss').Config} */

export default {
  content: [
      "./templates/**/*.{twig,svg}"
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/typography')
  ],
}
