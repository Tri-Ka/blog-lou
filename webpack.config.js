var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/assets/')
    .setPublicPath('/assets')

    .addEntry('admin/admin', [
        './app/Resources/assets/js/admin/app.js',
        './app/Resources/assets/sass/admin/style.scss'
    ])

    .addEntry('front/front', [
        './app/Resources/assets/js/front/app.js',
        './app/Resources/assets/sass/front/style.scss'
    ])

    .enableSassLoader()
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();
