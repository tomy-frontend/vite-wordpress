import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    rollupOptions: {
      input: {
        main: "src/js/main.js",
        style: "src/scss/style.scss",
      },
      output: {
        entryFileNames: `assets/[name].js`,
        chunkFileNames: `assets/[name].js`,
        assetFileNames: `assets/[name].[ext]`,
      },
    },
  },
  server: {
    cors: true,
    strictPort: true,
    port: 5173,
    hmr: {
      host: "localhost",
    },
  },
});
