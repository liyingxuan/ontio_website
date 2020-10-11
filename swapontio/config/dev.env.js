'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  BASE_URL: '"https://localhost/"',
  API_URL: '"https://swap.ont.io"',
  TEST_API_URL: '"https://swap.ont.io"',
  BC_URL: '"https://localhost:10443/api/v1/"',
  NET:true
})
