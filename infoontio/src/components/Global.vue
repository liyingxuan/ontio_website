<script type="text/javascript">
const privatekey = ''
const publicKey =''
const filename =''
const language = "en"
const languageFlag = false
const wallet = []
const accounts = []
const signatureData =''
const basicstepFlag =false
const idstepFlag =false
const socialstepFlag = false
const notpassFlag = false
const searchType ="1"
/* personalinfo */
const EmailCode =''
const Email =''
const Name =''
const Phone =''
const numbershow =''
const Nation =''
const countryName =''
const IdNumber =''
const IdType =''
const PictureFrontEnd =''
const PictureBackEnd =''
const PictureWithMan =''
const WebChatName =''
const WebChatId =''
const QQ =''
const Telegram =''
const Weibo =''
const Twitter =''
const Slack ='' 
const NeoAddress =''
const phoneCode =''
/* 加密 */
const NameEncrypt =''
const PhoneEncrypt =''
const IdNumberEncrypt =''
const WebChatNameEncrypt =''
const WebChatIdEncrypt =''
const QQEncrypt =''
const TelegramEncrypt =''
const WeiboEncrypt =''
const SlackEncrypt =''
const TwitterEncrypt =''
const NeoAddressEncrypt =''


const article ={
    	      Id:"",
	      Title:"",
	      OutLineFlag:false,
	      OutLine:"",
	      HideFlag:false,
	      Author:"",
	      NewsTime:"",
	      Language:"en",
          Summary:"",
          Category:"",
          PicUrl:"",
	      Detail:[
            {
                picurl:"",
                personPic:false,
                h3:"",
                content:""
            }
          ]
}
const newsAccount=""
const newsPassword=""
const newssearchType="0"
const newssearchlang="1"
const newseditFlag=false
const newsID=""

const starttime = 0
const RSApublickey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCuRKYGS3oFwv4IKALtaNLFet1EHuyc5GP8FPnv/ZX8gydQ75Q8rJNIMw9CJZ2OEabkSGJrHFiAG+lArlQE0VQxUk4igzH4dc8IL2axe16+daj7bTmpz4lto0Ca9KCkVKWWwQKLtfC01bSFOvu1S7GNTwqKoOPL/+eJiBT5qBBQsQIDAQAB'
function getRandColor () {
 var tem = Math.round(Math.random() * colorListLength)
 return colorList[tem]
}
// 不对图片进行压缩，直接转成base64  
function directTurnIntoBase64(fileObj,callback){  
    var r = new FileReader();  
    // 转成base64  
    r.onload = function(){  
        //变成字符串  
        var imgBase64 = r.result;  
        console.log(imgBase64);  
        callback(imgBase64);  
    }  
    r.readAsDataURL(fileObj);    //转成Base64格式  
}  
  
// 对图片进行压缩  
function compress(fileObj, callback) {   
    if ( typeof (FileReader) === 'undefined') {    
        console.log("当前浏览器内核不支持base64图标压缩");    
        //调用上传方式不压缩    
        directTurnIntoBase64(fileObj,callback);  
    } else {    
        try {      
            var reader = new FileReader();    
            reader.onload = function (e) {    
                    var image = $('<img/>');    
                    image.load(function(){    
                    var square = 600   //定义画布的大小，也就是图片压缩之后的像素  
                    var canvas = document.createElement('canvas')
                    var context = canvas.getContext('2d')  
                    var imageWidth = 0    //压缩图片的大小  
                    var imageHeight = 0  
                    var offsetX = 0 
                    var offsetY = 0  
                    var data = '' 
  
/*                     canvas.width = square;    
                    canvas.height = square;   
                    context.clearRect(0, 0, square, square); */     
                    debugger
                    if (this.width > this.height) {    
                        imageWidth = Math.round(square *this.width / this.height);    
                        imageHeight = square;    
/*                         offsetX = - Math.round((imageWidth - square) / 2);   */  
                    } else {    
                        imageHeight = Math.round(square * this.height / this.width);    
                        imageWidth = square;    
/*                         offsetY = - Math.round((imageHeight - square) / 2);     */
                    }   
                    canvas.width = imageWidth;    
                    canvas.height = imageHeight;   
                    context.clearRect(0, 0, canvas.width, canvas.height );     
                    context.drawImage(this, offsetX, offsetY, imageWidth, imageHeight);    
                    var data = canvas.toDataURL('image/jpeg');    
                    //压缩完成执行回调    
                     callback(data);    
                });    
                image.attr('src', e.target.result);    
            };    
            reader.readAsDataURL(fileObj);    
        }catch(e){    
            console.log("压缩失败!");    
            //调用直接上传方式  不压缩   
            directTurnIntoBase64(fileObj,callback);   
        }    
    }  
}  
function encrypt(pubkey,value,callback ){
    var encrypt = new JSEncrypt();
    encrypt.setPublicKey(pubkey);
    var encrypted = encrypt.encrypt(value);
    callback(encrypted); 
}
function encode(str){
    var b = new Base64();
    var encodestr = b.encode(str); 
    return encodestr     
}
function setclock(statu){
    if(statu=="1"){
        console.log("start")
        var a =  setTimeout(() => {
        alert("timeout")
        }
        ,6000)        
    }
    if(statu=="2"){
        console.log("stop")
        clearTimeout(a);       
    }
    if(statu=="3"){
        console.log("stop")
        clearTimeout(a);   
        console.log("start") 
        var a =  setTimeout(() => {
        alert("timeout")
        }
        ,6000)    
    }
}
export default
{
 EmailCode,
 Email,
 Name,
 Name,
 Phone,
 Phone,
 Nation,
 NeoAddress,
 IdNumber,
 IdType,
 PictureFrontEnd,
 PictureBackEnd,
 PictureWithMan,
 WebChatName,
 WebChatId,
 QQ,
 Telegram,
 Weibo,
 Slack,
 Twitter,
 language,
 languageFlag,
 getRandColor,
 directTurnIntoBase64,
 compress,
 starttime,
 wallet,
 accounts,
 signatureData,
 privatekey,
 publicKey,
 filename,
 encode,
 encrypt,
 setclock,
 countryName,
 numbershow,
 basicstepFlag,
 idstepFlag,
 socialstepFlag,
 phoneCode,
 RSApublickey,
 NameEncrypt,
 PhoneEncrypt,
 IdNumberEncrypt,
 WebChatNameEncrypt,
 WebChatIdEncrypt,
 QQEncrypt,
 TelegramEncrypt,
 WeiboEncrypt,
 SlackEncrypt,
 TwitterEncrypt,
 NeoAddressEncrypt,
 notpassFlag,
 searchType,
 article,
 newsAccount,
 newsPassword,
 newssearchType,
 newssearchlang,
 newseditFlag,
 newsID
}
</script>