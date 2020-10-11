/**
 * Created by tanyuan on 4/5/2017.
 */
export const API_ROOT = (process.env.NODE_ENV === 'production')
  ? 'https://ont.io/'
 /*  ? 'http://47.52.72.227:8989/' */
/*   ? 'http://45.249.245.142:8989/' */
//:'http://42.159.252.240:7070/'
:(process.env.NODE_ENV === 'mock_development')?'http://localhost:3000/':'https://ont.io/'

export const CookieDomain = (process.env.NODE_ENV === 'production')
  ? ''
  :''
