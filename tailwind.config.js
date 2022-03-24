module.exports = {
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
