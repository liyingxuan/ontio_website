import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const App = r => require.ensure([], () => r(require('../App')), 'app')

const application = r => require.ensure([], () => r(require('../components/application')), 'application')
const news = r => require.ensure([], () => r(require('../components/news')), 'news')
const cooperation = r => require.ensure([], () => r(require('../components/cooperation')), 'cooperation')
const article = r => require.ensure([], () => r(require('../components/article')), 'article')
const team = r => require.ensure([], () => r(require('../components/team')), 'team')
const TrionesMustRead = r => require.ensure([], () => r(require('../components/TrionesMustRead')), 'TrionesMustRead')
const TrionesList = r => require.ensure([], () => r(require('../components/TrionesList')), 'TrionesList')
const developer = r => require.ensure([], () => r(require('../components/developer')), 'developer')
const bounty = r => require.ensure([], () => r(require('../components/bounty')), 'bounty')
const TrustAnchors = r => require.ensure([], () => r(require('../components/TrustAnchors')), 'TrustAnchors')
const TrustAnchorCoverage = r => require.ensure([], () => r(require('../components/TrustAnchorCoverage')), 'TrustAnchorCoverage')



const ontView = r => require.ensure([], () => r(require('../components/ontView')), 'ontView')
const viewpoint = r => require.ensure([], () => r(require('../components/viewpoint')), 'viewpoint')



const routes = [
  {
    path: '/',
    component: App,
    children: [
      {
        path: '',
        redirect: '',
        component: ontView
      },
      {
        path: '/application/:page/:lang',
        component: application
      },
      {
        path: '/news/:lang',
        component: news
      },
      {
        path: '/trust-anchor/:lang',
        component: TrustAnchors
      },
      {
        path: '/trust-anchor-coverage/:lang',
        component: TrustAnchorCoverage
      },
      {
        path: '/ont-view/:lang',
        component: ontView
      },
      {
        path: '/view-point/:id/:lang',
        component: viewpoint
      },
      {
        path: '/cooperation/:lang',
        component: cooperation
      },
      {
        path: '/press/:id/:lang',
        component: article
      },
      {
        path: '/team/:lang',
        component: team
      },
      {
        path: '/application/:page/:lang',
        component: application
      },
      {
        path: '/news',
        component: news
      },
      {
        path: '/ont-view',
        component: ontView
      },
      {
        path: '/view-point',
        component: viewpoint
      },
      {
        path: '/cooperation',
        component: cooperation
      },
      {
        path: '/press/:id',
        component: article
      },
      {
        path: '/team',
        component: team
      },
      {
        path: '/trionesintro/:lang',
        component: TrionesMustRead
      },
      {
        path: '/trionesintro',
        component: TrionesMustRead
      },
      {
        path: '/listtriones/:lang',
        component: TrionesList
      },
/*       {
        path: '/developer/:lang',
        component: developer
      },
      {
        path: '/developer',
        component: developer
      },
      {
        path: '/bounty/:lang',
        component: bounty
      },
      {
        path: '/bounty',
        component: bounty
      }, */

    ]
  },
  { path: '*', redirect: '/' }
];

const router = new Router({
  mode: 'history',
  scrollBehavior: () => ({ y: 0 }),
  routes
})

/*  router.beforeEach((to, from, next) => {
  alert(to)
  console.log(from)
  next()
})  */
export default router
/* export default new Router({
  mode: 'hash',
  scrollBehavior: () => ({ y: 0 }),
  routes
}) */

