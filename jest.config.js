module.exports = {
  testRegex: 'resources/assets/js/test/.*.spec.js$',
  moduleFileExtensions: [
    'js',
    'json',
    'vue'
  ],
  'transform': {
    '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
    '.*\\.(vue)$': '<rootDir>/node_modules/vue-jest'
  },
  "moduleNameMapper": {
    "\\.(css|less)$": "<rootDir>/resources/assets/js/test/__mocks__/styleMock.js"
  },
  "setupTestFrameworkScriptFile": "<rootDir>/resources/assets/js/test/setup.js"
}