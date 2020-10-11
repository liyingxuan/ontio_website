const express = require('express'),
    router = express(),
    sql = require('../module/mysql');

router.get("/",(req,res)=>{
    res.render('index',{page:"index"});
}); // 首页
router.get("/about",(req,res)=>{
    res.render('about',{page: "about"});
}); 
// 路线图
router.get("/documents",(req,res)=>{
    res.render('developer',{page:"developer"});
}); // 开发者
/* router.get("/view",(req,res)=>{
    res.render('view',{page:"view"});
});  */
// 本体视点
/* router.get("/contact",(req,res)=>{
    res.render('contact',{page:"contact"});
}); */ 
// 联系我们
/* router.get("/news",(req,res)=>{
    res.render('news',{page:'news'});
});  */
// 新闻
/* router.get("/faq",(req,res)=>{
    res.render('faq',{page:"faq"});
});  */
// FAQ
/* router.get("/activity",(req,res)=>{
    res.render('activity',{page:'activity'});
});  */
// 活动页面
/* router.get("/team",(req,res)=>{
    res.render('team',{page:"team"});
});  */
// 团队
/* router.get("/detail",(req,res)=>{
    res.render('detail',{page:"detail"});
});  */
// 文章详情


router.get("/admin",(req,res)=>{
    res.render('admin/index');
}); // 管理后台
router.get("/admin/article",(req,res)=>{
    res.render('admin/article');
}); // 发布文章

module.exports = router;