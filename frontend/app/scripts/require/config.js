requirejs.config({
  baseUrl: '',

  paths: {
    'jquery' : 'bower_components/jquery/jquery',
    'backbone' : 'bower_components/backbone/backbone',
    'underscore' : 'bower_components/underscore/underscore',
    'semantic-ui' : 'bower_components/semantic-ui/build/packaged/javascript/semantic',

    // React
    'jsx': "scripts/require/jsx",
    'JSXTransformer': 'bower_components/react/JSXTransformer',
    'react' : 'bower_components/react/react',

    // Models
    'member' : "scripts/models/member"
  },

  shim: {
    'bower_components/underscore/underscore': {
      exports: '_'
    },
    'bower_components/jquery/jquery': {
      exports: 'jQuery'
    },
    'bower_components/semantic-ui/build/packaged/javascript/semantic': {
      exports: "jQuery",
      deps: ['jquery']
    },
    'bower_components/backbone/backbone': {
      deps: ['underscore']
    , exports: 'Backbone'
    },
    'bower_components/react/react': {
      exports: 'React'
    },
    'JSXTransformer': {
        exports: "JSXTransformer"
    }
  }
});
