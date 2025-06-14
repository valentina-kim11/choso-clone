export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#00796B',
        secondary: '#4FC3F7',
        dark: '#111827',
        'brand-gray': '#374151',
        accent: '#FFD54F',
        info: '#E0F2F1',
        danger: '#EF5350',
      },
      ringColor: {
        accent: '#FFD54F',
      },
    },
  },
  plugins: [],
}
