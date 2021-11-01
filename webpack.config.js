const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            // Leaflet image Alias resolutions (https://github.com/Leaflet/Leaflet/issues/4849#issuecomment-307436996)
            './images/layers.png$': path.resolve('node_modules/leaflet/dist/images/layers.png'),
            './images/layers-2x.png$': path.resolve('node_modules/leaflet/dist/images/layers-2x.png'),
            './images/marker-icon.png$': path.resolve('node_modules/leaflet/dist/images/marker-icon.png'),
            './images/marker-icon-2x.png$': path.resolve('node_modules/leaflet/dist/images/marker-icon-2x.png'),
            './images/marker-shadow.png$': path.resolve('node_modules/leaflet/dist/images/marker-shadow.png'),
        },
    },
};
