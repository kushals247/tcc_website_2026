module.exports = {
  content: [
    './**/*.php',
    './assets/js/**/*.js',
  ],
  safelist: [
    'text-[#FFCD00]', 'bg-[#FFCD00]', 'border-[#FFCD00]', 'hover:border-[#FFCD00]',
    'hover:bg-[#FFD52E]', 'focus:border-[#FFCD00]',
    'text-[#63666A]', 'bg-[#63666A]', 'border-[#63666A]', 'hover:text-[#63666A]',
    'text-[#3A3D40]', 'bg-[#3A3D40]', 'hover:bg-[#3A3D40]',
    'bg-[#ECECEC]', 'border-[#ECECEC]',
    'bg-[#F5F6F7]',
    'bg-[#FFD52E]',
    'text-white', 'text-white/80', 'text-white/85',
    'hover:bg-white/10',
    'border-white',
  ],
  theme: { extend: {} },
  plugins: [],
};
