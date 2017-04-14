/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.5
 *  @license MIT https://github.com/rmariuzzo/Lang.js/blob/master/LICENSE
 *  @site    https://github.com/rmariuzzo/Lang.js
 *  @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
(function(root,factory){"use strict";if(typeof define==="function"&&define.amd){define([],factory)}else if(typeof exports==="object"){module.exports=factory()}else{root.Lang=factory()}})(this,function(){"use strict";function inferLocale(){if(typeof document!=="undefined"&&document.documentElement){return document.documentElement.lang}}function convertNumber(str){if(str==="-Inf"){return-Infinity}else if(str==="+Inf"||str==="Inf"){return Infinity}return parseInt(str,10)}var intervalRegexp=/^({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\-?\d+(\.\d+)?)\s*([\[\]])$/;var anyIntervalRegexp=/({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\-?\d+(\.\d+)?)\s*([\[\]])/;var defaults={locale:"en"};var Lang=function(options){options=options||{};this.locale=options.locale||inferLocale()||defaults.locale;this.fallback=options.fallback;this.messages=options.messages};Lang.prototype.setMessages=function(messages){this.messages=messages};Lang.prototype.getLocale=function(){return this.locale||options.fallback};Lang.prototype.setLocale=function(locale){this.locale=locale};Lang.prototype.getFallback=function(){return this.fallback};Lang.prototype.setFallback=function(fallback){this.fallback=fallback};Lang.prototype.has=function(key,locale){if(typeof key!=="string"||!this.messages){return false}return this._getMessage(key,locale)!==null};Lang.prototype.get=function(key,replacements,locale){if(!this.has(key)){return key}var message=this._getMessage(key,locale);if(message===null){return key}if(replacements){message=this._applyReplacements(message,replacements)}return message};Lang.prototype.trans=function(key,replacements){return this.get(key,replacements)};Lang.prototype.choice=function(key,number,replacements,locale){replacements=typeof replacements!=="undefined"?replacements:{};replacements.count=number;var message=this.get(key,replacements,locale);if(message===null||message===undefined){return message}var messageParts=message.split("|");var explicitRules=[];for(var i=0;i<messageParts.length;i++){messageParts[i]=messageParts[i].trim();if(anyIntervalRegexp.test(messageParts[i])){var messageSpaceSplit=messageParts[i].split(/\s/);explicitRules.push(messageSpaceSplit.shift());messageParts[i]=messageSpaceSplit.join(" ")}}if(messageParts.length===1){return message}for(var j=0;j<explicitRules.length;j++){if(this._testInterval(number,explicitRules[j])){return messageParts[j]}}var pluralForm=this._getPluralForm(number);return messageParts[pluralForm]};Lang.prototype.transChoice=function(key,count,replacements){return this.choice(key,count,replacements)};Lang.prototype._parseKey=function(key,locale){if(typeof key!=="string"||typeof locale!=="string"){return null}var segments=key.split(".");var source=segments[0].replace(/\//g,".");return{source:locale+"."+source,sourceFallback:this.getFallback()+"."+source,entries:segments.slice(1)}};Lang.prototype._getMessage=function(key,locale){locale=locale||this.getLocale();key=this._parseKey(key,locale);if(this.messages[key.source]===undefined&&this.messages[key.sourceFallback]===undefined){return null}var message=this.messages[key.source];var entries=key.entries.slice();while(entries.length&&(message=message[entries.shift()]));if(typeof message!=="string"&&this.messages[key.sourceFallback]){message=this.messages[key.sourceFallback];entries=key.entries.slice();while(entries.length&&(message=message[entries.shift()]));}if(typeof message!=="string"){return null}return message};Lang.prototype._applyReplacements=function(message,replacements){for(var replace in replacements){message=message.split(":"+replace).join(replacements[replace])}return message};Lang.prototype._testInterval=function(count,interval){if(typeof interval!=="string"){throw"Invalid interval: should be a string."}interval=interval.trim();var matches=interval.match(intervalRegexp);if(!matches){throw new"Invalid interval: "+interval}if(matches[2]){var items=matches[2].split(",");for(var i=0;i<items.length;i++){if(parseInt(items[i],10)===count){return true}}}else{matches=matches.filter(function(match){return!!match});var leftDelimiter=matches[1];var leftNumber=convertNumber(matches[2]);var rightNumber=convertNumber(matches[3]);var rightDelimiter=matches[4];return(leftDelimiter==="["?count>=leftNumber:count>leftNumber)&&(rightDelimiter==="]"?count<=rightNumber:count<rightNumber)}return false};Lang.prototype._getPluralForm=function(count){switch(this.locale){case"az":case"bo":case"dz":case"id":case"ja":case"jv":case"ka":case"km":case"kn":case"ko":case"ms":case"th":case"tr":case"vi":case"zh":return 0;case"af":case"bn":case"bg":case"ca":case"da":case"de":case"el":case"en":case"eo":case"es":case"et":case"eu":case"fa":case"fi":case"fo":case"fur":case"fy":case"gl":case"gu":case"ha":case"he":case"hu":case"is":case"it":case"ku":case"lb":case"ml":case"mn":case"mr":case"nah":case"nb":case"ne":case"nl":case"nn":case"no":case"om":case"or":case"pa":case"pap":case"ps":case"pt":case"so":case"sq":case"sv":case"sw":case"ta":case"te":case"tk":case"ur":case"zu":return count==1?0:1;case"am":case"bh":case"fil":case"fr":case"gun":case"hi":case"hy":case"ln":case"mg":case"nso":case"xbr":case"ti":case"wa":return count===0||count===1?0:1;case"be":case"bs":case"hr":case"ru":case"sr":case"uk":return count%10==1&&count%100!=11?0:count%10>=2&&count%10<=4&&(count%100<10||count%100>=20)?1:2;case"cs":case"sk":return count==1?0:count>=2&&count<=4?1:2;case"ga":return count==1?0:count==2?1:2;case"lt":return count%10==1&&count%100!=11?0:count%10>=2&&(count%100<10||count%100>=20)?1:2;case"sl":return count%100==1?0:count%100==2?1:count%100==3||count%100==4?2:3;case"mk":return count%10==1?0:1;case"mt":return count==1?0:count===0||count%100>1&&count%100<11?1:count%100>10&&count%100<20?2:3;case"lv":return count===0?0:count%10==1&&count%100!=11?1:2;case"pl":return count==1?0:count%10>=2&&count%10<=4&&(count%100<12||count%100>14)?1:2;case"cy":return count==1?0:count==2?1:count==8||count==11?2:3;case"ro":return count==1?0:count===0||count%100>0&&count%100<20?1:2;case"ar":return count===0?0:count==1?1:count==2?2:count%100>=3&&count%100<=10?3:count%100>=11&&count%100<=99?4:5;default:return 0}};return Lang});(function(){Lang=new Lang();Lang.setMessages({"en.validation":{"accepted":"The :attribute must be accepted.","active_url":"The :attribute is not a valid URL.","after":"The :attribute must be a date after :date.","after_or_equal":"The :attribute must be a date after or equal to :date.","alpha":"The :attribute may only contain letters.","alpha_dash":"The :attribute may only contain letters, numbers, and dashes.","alpha_num":"The :attribute may only contain letters and numbers.","array":"The :attribute must be an array.","before":"The :attribute must be a date before :date.","before_or_equal":"The :attribute must be a date before or equal to :date.","between":{"numeric":"The :attribute must be between :min and :max.","file":"The :attribute must be between :min and :max kilobytes.","string":"The :attribute must be between :min and :max characters.","array":"The :attribute must have between :min and :max items."},"boolean":"The :attribute field must be true or false.","confirmed":"The :attribute confirmation does not match.","date":"The :attribute is not a valid date.","date_format":"The :attribute does not match the format :format.","different":"The :attribute and :other must be different.","digits":"The :attribute must be :digits digits.","digits_between":"The :attribute must be between :min and :max digits.","dimensions":"The :attribute has invalid image dimensions.","distinct":"The :attribute field has a duplicate value.","email":"The :attribute must be a valid email address.","exists":"The selected :attribute is invalid.","file":"The :attribute must be a file.","filled":"The :attribute field is required.","image":"The :attribute must be an image.","in":"The selected :attribute is invalid.","in_array":"The :attribute field does not exist in :other.","integer":"The :attribute must be an integer.","ip":"The :attribute must be a valid IP address.","json":"The :attribute must be a valid JSON string.","max":{"numeric":"The :attribute may not be greater than :max.","file":"The :attribute may not be greater than :max kilobytes.","string":"The :attribute may not be greater than :max characters.","array":"The :attribute may not have more than :max items."},"mimes":"The :attribute must be a file of type: :values.","mimetypes":"The :attribute must be a file of type: :values.","min":{"numeric":"The :attribute must be at least :min.","file":"The :attribute must be at least :min kilobytes.","string":"The :attribute must be at least :min characters.","array":"The :attribute must have at least :min items."},"not_in":"The selected :attribute is invalid.","numeric":"The :attribute must be a number.","present":"The :attribute field must be present.","regex":"The :attribute format is invalid.","required":"The :attribute field is required.","required_if":"The :attribute field is required when :other is :value.","required_unless":"The :attribute field is required unless :other is in :values.","required_with":"The :attribute field is required when :values is present.","required_with_all":"The :attribute field is required when :values is present.","required_without":"The :attribute field is required when :values is not present.","required_without_all":"The :attribute field is required when none of :values are present.","same":"The :attribute and :other must match.","size":{"numeric":"The :attribute must be :size.","file":"The :attribute must be :size kilobytes.","string":"The :attribute must be :size characters.","array":"The :attribute must contain :size items."},"string":"The :attribute must be a string.","timezone":"The :attribute must be a valid zone.","unique":"The :attribute has already been taken.","uploaded":"The :attribute failed to upload.","url":"The :attribute format is invalid.","custom":{"attribute-name":{"rule-name":"custom-message"}},"attributes":{"name":"name","description":"description","image":"image","fullname":"fullname","nickname":"nickname","email":"email","password":"password","phone":"phone","facebook_link":"link facebook","linkedin_link":"link linkedin","github_link":"link github","stackoverflow_link":"link stackoverflow","status":"status","alias":"alias","file":"file","link":"link","empty":"empty","content":"content","type":"type","object_id":"object","keyword":"keyword","time_tracking":"time tracking"}},"en.lfm":{"nav-back":"Back","nav-new":"New Folder","nav-upload":"Upload","nav-thumbnails":"Thumbnails","nav-list":"List","menu-rename":"Rename","menu-delete":"Delete","menu-view":"Preview","menu-download":"Download","menu-resize":"Resize","menu-crop":"Crop","title-page":"File Manager","title-panel":"Laravel FileManager","title-upload":"Upload File(s)","title-view":"View File","title-root":"Files","title-shares":"Shared Files","title-item":"Item","title-size":"Size","title-type":"Type","title-modified":"Modified","title-action":"Action","type-folder":"Folder","message-empty":"Folder is empty.","message-choose":"Choose File(s)","message-delete":"Are you sure you want to delete this item?","message-name":"Folder name:","message-rename":"Rename to:","message-extension_not_found":"Please install gd or imagick extension to crop, resize, and make thumbnails of images.","error-rename":"File name already in use!","error-file-name":"File name cannot be empty!","error-file-empty":"You must choose a file!","error-file-exist":"A file with this name already exists!","error-file-size":"File size exceeds server limit! (maximum size: :max)","error-delete-folder":"You cannot delete this folder because it is not empty!","error-folder-name":"Folder name cannot be empty!","error-folder-exist":"A folder with this name already exists!","error-folder-alnum":"Only alphanumeric folder names are allowed!","error-folder-not-found":"Folder  not found! (:folder)","error-mime":"Unexpected MimeType: ","error-size":"Over limit size:","error-instance":"The uploaded file should be an instance of UploadedFile","error-invalid":"Invalid upload request","error-other":"An error has occured: ","error-too-large":"Request entity too large!","btn-upload":"Upload File(s)","btn-uploading":"Uploading...","btn-close":"Close","btn-crop":"Crop","btn-cancel":"Cancel","btn-resize":"Resize","resize-ratio":"Ratio:","resize-scaled":"Image scaled:","resize-true":"Yes","resize-old-height":"Original Height:","resize-old-width":"Original Width:","resize-new-height":"Height:","resize-new-width":"Width:","locale-bootbox":"en"},"en.admin.search":{"search":"Search","keyword":"Keyword","status":"Status","type":"Type","parent":"Parent","rank":"Rank","role":"Role","object":"Object","article":"Article","document":"Document","user":"User","placeholder":{"input":":input","choice":"---Choice :choice---"},"btn":{"search":"Search","cancel":"Cancel"},"input":{"category":"Name, Description","user":"Name, Username, Email, Phone, Link","document":"Name, Alias, Description, File, Link","comment":"Content"},"choice":{"parent":"parent","status":"status","type":"type","rank":"rank","role":"role","object":"object","user":"user","article":"article","document":"document"}},"en.admin.category":{"list":"List categories","create":"Create a category","edit":"Edit a category","detail":"Detail a category","table_head":["No","Name","Description","Image","Parent"],"table_head_width":["w-50","w-200","w-350","w-100","w-200"],"placeholder":{"name":"Enter name","description":"Enter description","parent":"Choose parent of category"},"button":{"save":"Save","close":"Close","back":"Back","add_new":"Continue add"},"info":{"parent":"Parent information","name":"Name","description":"Description","image":"Image"}},"en.admin.user":{"list":"List users","create":"Create a user","edit":"Edit a user","detail":"Detail a user","table_head":["No","Username","Email","Phone","Rank","Role"],"table_head_width":["w-50","w-200","w-200","w-100","w-100","w-150"],"placeholder":{"fullname":"Enter fullname","nickname":"Enter username","email":"Enter email","password":"Enter password","phone":"Enter phone number","facebook_link":"Enter link of facebook","linkedin_link":"Enter link of linkedin","github_link":"Enter link of github","stackoverflow_link":"Enter link of stackoverflow","status":"Do you want pubic information(phone, email, ..)?"},"button":{"save":"Save","close":"Close","back":"Back","add_new":"Continue add"},"info":{"fullname":"Fullname","nickname":"Username","email":"Email address","password":"Password","phone":"Phone number","facebook_link":"Facebook","linkedin_link":"Linkedin","github_link":"Github","stackoverflow_link":"Stackoverflow","status":"Status","status_public":"Yes","status_private":"No","rank":"Rank","role":"Role"},"status":["not show info","show info"],"rank":["No rank","Platinum","Gold","Silver","Bronze"],"role":["No define","Admin","Super","User"]},"en.admin.master":{"sidebar":{"item":":item","list":"List","create":"Create"},"info":{"name":"Admin","status":"Online"},"items":{"user":"User","category":"Category","article":"Article","session":"Session","document":"Document","comment":"Comment"}},"en.admin.comment":{"list":"List comments","edit":"Edit a comment","detail":"Detail a comment","table_head":["No","Content","User","Type","Object","Status"],"table_head_width":["w-50","w-200","w-150","w-100","w-200","w-150"],"button":{"save":"Save","close":"Close","back":"Back"},"placeholder":{"content":"Enter content","type":"Choose type","object":"Choose object","status":"Choose status"},"info":{"content":"Content","type":"Type","object":"Object","article":"Article","document":"Document","status":"Status","waiting":"\u0110ang \u0111\u1ee3i","public":"\u0110\u00e3 duy\u1ec7t","cancel":"\u0110\u00e3 h\u1ee7y","user":"User"},"type":["Invalid","Article","Document"],"status":["Invalid","Waiting","Public","Cancel"]},"en.admin.document":{"list":"List documents","create":"Create a document","edit":"Edit a document","detail":"Detail a document","table_head":["No","Name","Document","Status","User"],"table_head_width":["w-50","w-200","w-200","w-100","w-150"],"placeholder":{"name":"Enter name","alias":"Enter alias","description":"Enter description","link":"Enter link","file":"Upload file"},"button":{"save":"Save","close":"Close","back":"Back","add_new":"Continue add"},"info":{"name":"Name","description":"Description","file":"File","link":"Link","status":"Status","user":"User","alias":"Alias"},"status":["Invalid","Waiting","Public","Cancel"]},"en.message":{"info":{"not_items_in_list":"Item not found in list"},"warning":[],"success":{"create":"Create a :item success","update":"Update a :item success","delete":"Delete a :item success","ajax":"Handle success","deleteMultiple":"Delete success"},"danger":{"create":"Create a :item fail","update":"Update a :item fail","delete":"Delete a :item fail","not_found":"Not found this :item","download":"Not download this file","ajax":"Handle fail","deleteMultiple":"Delete fail"},"confirm":{"delete":"Do you want this :item?"},"items":{"category":"category","user":"user","document":"document","comment":"comment"}},"en.general":{"label":{"search":"Search","keyword":"Keyword","status":"Status","list":"List","stt":"No.","edit":"Edit","detail":"Detail","delete":"Delete","name":"Name","alias":"Alias","description":"Description","content":"Content","image":"Image","author":"Author","function":"Function","no_results":"No results","create_new":"Create New","category":"Category","lesson":"Lesson","update":"Update","count_share":"Count share","time_tracking":"Time tracking","waiting":"Waiting","public":"Public","cancel":"Cancel","blog":"Blog","yes":"Yes","no":"No","questions_list":"Questions List","question":"Question","add_question":"Add question","add_answer":"Add answer","answer":"Answer","explain":"Explain"},"btn":{"cancel":"Cancel","search":"Search","save":"Save","back":"Back"}},"en.passwords":{"password":"Passwords must be at least six characters and match the confirmation.","reset":"Your password has been reset!","sent":"We have e-mailed your password reset link!","token":"This password reset token is invalid.","user":"We can't find a user with that e-mail address."},"en.auth":{"failed":"These credentials do not match our records.","throttle":"Too many login attempts. Please try again in :seconds seconds.","email_password_invalid":"Email password invalid"},"en.ajax":{"delete_multiple":{"objectAjax":{"required":"Object deleted invalid"},"dataAjax":{"required":"Data choice invalid","array":"Data choice must is array","exists":"Data :value choice have not into database"},"not_choice_item":"Not item selected","confirm":"Do you want delete this items"}},"en.pagination":{"previous":"&laquo; Previous","next":"Next &raquo;"},"vi.validation":{"accepted":"Tr\u01b0\u1eddng :attribute ph\u1ea3i \u0111\u01b0\u1ee3c ch\u1ea5p nh\u1eadn.","active_url":"Tr\u01b0\u1eddng :attribute kh\u00f4ng ph\u1ea3i l\u00e0 m\u1ed9t URL h\u1ee3p l\u1ec7.","after":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t ng\u00e0y sau ng\u00e0y :date.","after_or_equal":"The :attribute must be a date after or equal to :date.","alpha":"Tr\u01b0\u1eddng :attribute ch\u1ec9 c\u00f3 th\u1ec3 ch\u1ee9a c\u00e1c ch\u1eef c\u00e1i.","alpha_dash":"Tr\u01b0\u1eddng :attribute ch\u1ec9 c\u00f3 th\u1ec3 ch\u1ee9a ch\u1eef c\u00e1i, s\u1ed1 v\u00e0 d\u1ea5u g\u1ea1ch ngang.","alpha_num":"Tr\u01b0\u1eddng :attribute ch\u1ec9 c\u00f3 th\u1ec3 ch\u1ee9a ch\u1eef c\u00e1i v\u00e0 s\u1ed1.","array":"Ki\u1ec3u d\u1eef li\u1ec7u c\u1ee7a tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 d\u1ea1ng m\u1ea3ng.","before":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t ng\u00e0y tr\u01b0\u1edbc ng\u00e0y :date.","before_or_equal":"The :attribute must be a date before or equal to :date.","between":{"numeric":"Tr\u01b0\u1eddng :attribute ph\u1ea3i n\u1eb1m trong kho\u1ea3ng :min - :max.","file":"Dung l\u01b0\u1ee3ng t\u1eadp tin trong tr\u01b0\u1eddng :attribute ph\u1ea3i t\u1eeb :min - :max kB.","string":"Tr\u01b0\u1eddng :attribute ph\u1ea3i t\u1eeb :min - :max k\u00fd t\u1ef1.","array":"Tr\u01b0\u1eddng :attribute ph\u1ea3i c\u00f3 t\u1eeb :min - :max ph\u1ea7n t\u1eed."},"boolean":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 true ho\u1eb7c false.","confirmed":"Gi\u00e1 tr\u1ecb x\u00e1c nh\u1eadn trong tr\u01b0\u1eddng :attribute kh\u00f4ng kh\u1edbp.","date":"Tr\u01b0\u1eddng :attribute kh\u00f4ng ph\u1ea3i l\u00e0 \u0111\u1ecbnh d\u1ea1ng c\u1ee7a ng\u00e0y-th\u00e1ng.","date_format":"Tr\u01b0\u1eddng :attribute kh\u00f4ng gi\u1ed1ng v\u1edbi \u0111\u1ecbnh d\u1ea1ng :format.","different":"Tr\u01b0\u1eddng :attribute v\u00e0 :other ph\u1ea3i kh\u00e1c nhau.","digits":"\u0110\u1ed9 d\u00e0i c\u1ee7a tr\u01b0\u1eddng :attribute ph\u1ea3i g\u1ed3m :digits ch\u1eef s\u1ed1.","digits_between":"\u0110\u1ed9 d\u00e0i c\u1ee7a tr\u01b0\u1eddng :attribute ph\u1ea3i n\u1eb1m trong kho\u1ea3ng :min and :max ch\u1eef s\u1ed1.","dimensions":"Tr\u01b0\u1eddng :attribute c\u00f3 k\u00edch th\u01b0\u1edbc kh\u00f4ng h\u1ee3p l\u1ec7.","distinct":"Tr\u01b0\u1eddng :attribute c\u00f3 gi\u00e1 tr\u1ecb tr\u00f9ng l\u1eb7p.","email":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t \u0111\u1ecba ch\u1ec9 email h\u1ee3p l\u1ec7.","exists":"Gi\u00e1 tr\u1ecb \u0111\u00e3 ch\u1ecdn trong tr\u01b0\u1eddng :attribute kh\u00f4ng h\u1ee3p l\u1ec7.","file":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t t\u1ec7p tin.","filled":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng.","image":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 \u0111\u1ecbnh d\u1ea1ng h\u00ecnh \u1ea3nh.","in":"Gi\u00e1 tr\u1ecb \u0111\u00e3 ch\u1ecdn trong tr\u01b0\u1eddng :attribute kh\u00f4ng h\u1ee3p l\u1ec7.","in_array":"Tr\u01b0\u1eddng :attribute ph\u1ea3i thu\u1ed9c t\u1eadp cho ph\u00e9p: :other.","integer":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t s\u1ed1 nguy\u00ean.","ip":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t \u0111\u1ecba ch\u1ec9 IP.","json":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t chu\u1ed7i JSON.","max":{"numeric":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c l\u1edbn h\u01a1n :max.","file":"Dung l\u01b0\u1ee3ng t\u1eadp tin trong tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c l\u1edbn h\u01a1n :max kB.","string":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c l\u1edbn h\u01a1n :max k\u00fd t\u1ef1.","array":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c l\u1edbn h\u01a1n :max ph\u1ea7n t\u1eed."},"mimes":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t t\u1eadp tin c\u00f3 \u0111\u1ecbnh d\u1ea1ng: :values.","mimetypes":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t t\u1eadp tin c\u00f3 \u0111\u1ecbnh d\u1ea1ng: :values.","min":{"numeric":"Tr\u01b0\u1eddng :attribute ph\u1ea3i t\u1ed1i thi\u1ec3u l\u00e0 :min.","file":"Dung l\u01b0\u1ee3ng t\u1eadp tin trong tr\u01b0\u1eddng :attribute ph\u1ea3i t\u1ed1i thi\u1ec3u :min kB.","string":"Tr\u01b0\u1eddng :attribute ph\u1ea3i c\u00f3 t\u1ed1i thi\u1ec3u :min k\u00fd t\u1ef1.","array":"Tr\u01b0\u1eddng :attribute ph\u1ea3i c\u00f3 t\u1ed1i thi\u1ec3u :min ph\u1ea7n t\u1eed."},"not_in":"Gi\u00e1 tr\u1ecb \u0111\u00e3 ch\u1ecdn trong tr\u01b0\u1eddng :attribute kh\u00f4ng h\u1ee3p l\u1ec7.","numeric":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t s\u1ed1.","present":"Tr\u01b0\u1eddng :attribute ph\u1ea3i \u0111\u01b0\u1ee3c cung c\u1ea5p.","regex":"\u0110\u1ecbnh d\u1ea1ng tr\u01b0\u1eddng :attribute kh\u00f4ng h\u1ee3p l\u1ec7.","required":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng.","required_if":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng khi tr\u01b0\u1eddng :other l\u00e0 :value.","required_unless":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng tr\u1eeb khi :other l\u00e0 :values.","required_with":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng khi m\u1ed9t trong :values c\u00f3 gi\u00e1 tr\u1ecb.","required_with_all":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng khi t\u1ea5t c\u1ea3 :values c\u00f3 gi\u00e1 tr\u1ecb.","required_without":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng khi m\u1ed9t trong :values kh\u00f4ng c\u00f3 gi\u00e1 tr\u1ecb.","required_without_all":"Tr\u01b0\u1eddng :attribute kh\u00f4ng \u0111\u01b0\u1ee3c b\u1ecf tr\u1ed1ng khi t\u1ea5t c\u1ea3 :values kh\u00f4ng c\u00f3 gi\u00e1 tr\u1ecb.","same":"Tr\u01b0\u1eddng :attribute v\u00e0 :other ph\u1ea3i gi\u1ed1ng nhau.","size":{"numeric":"Tr\u01b0\u1eddng :attribute ph\u1ea3i b\u1eb1ng :size.","file":"Dung l\u01b0\u1ee3ng t\u1eadp tin trong tr\u01b0\u1eddng :attribute ph\u1ea3i b\u1eb1ng :size kB.","string":"Tr\u01b0\u1eddng :attribute ph\u1ea3i ch\u1ee9a :size k\u00fd t\u1ef1.","array":"Tr\u01b0\u1eddng :attribute ph\u1ea3i ch\u1ee9a :size ph\u1ea7n t\u1eed."},"string":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t chu\u1ed7i k\u00fd t\u1ef1.","timezone":"Tr\u01b0\u1eddng :attribute ph\u1ea3i l\u00e0 m\u1ed9t m\u00fai gi\u1edd h\u1ee3p l\u1ec7.","unique":"Tr\u01b0\u1eddng :attribute \u0111\u00e3 c\u00f3 trong c\u01a1 s\u1edf d\u1eef li\u1ec7u.","uploaded":"Tr\u01b0\u1eddng :attribute t\u1ea3i l\u00ean th\u1ea5t b\u1ea1i.","url":"Tr\u01b0\u1eddng :attribute kh\u00f4ng gi\u1ed1ng v\u1edbi \u0111\u1ecbnh d\u1ea1ng m\u1ed9t URL.","custom":{"attribute-name":{"rule-name":"custom-message"}},"attributes":{"name":"t\u00ean","description":"m\u00f4 t\u1ea3","image":"h\u00ecnh \u1ea3nh","fullname":"t\u00ean","nickname":"t\u00ean \u0111\u0103ng nh\u1eadp","email":"email","password":"m\u1eadt kh\u1ea9u","phone":"s\u1ed1 \u0111i\u1ec7n tho\u1ea1i","facebook_link":"link facebook","linkedin_link":"link linkedin","github_link":"link github","stackoverflow_link":"link stackoverflow","status":"tr\u1ea1ng th\u00e1i th\u00f4ng tin","alias":"t\u00ean \u0111\u1ecbnh danh","file":"file","link":"li\u00ean k\u1ebft","empty":"tr\u1ed1ng","content":"n\u1ed9i dung","type":"lo\u1ea1i","object_id":"\u0111\u1ed1i t\u01b0\u1ee3ng","keyword":"t\u1eeb kh\u00f3a","time_tracking":"th\u1eddi gian l\u00e0m b\u00e0i"}},"vi.lfm":{"nav-back":"Back","nav-new":"New Folder","nav-upload":"Upload","nav-thumbnails":"Thumbnails","nav-list":"List","menu-rename":"Rename","menu-delete":"Delete","menu-view":"Preview","menu-download":"Download","menu-resize":"Resize","menu-crop":"Crop","title-page":"File Manager","title-panel":"Laravel FileManager","title-upload":"Upload File(s)","title-view":"View File","title-root":"Files","title-shares":"Shared Files","title-item":"Item","title-size":"Size","title-type":"Type","title-modified":"Modified","title-action":"Action","type-folder":"Folder","message-empty":"Folder is empty.","message-choose":"Choose File(s)","message-delete":"Are you sure you want to delete this item?","message-name":"Folder name:","message-rename":"Rename to:","message-extension_not_found":"Please install gd or imagick extension to crop, resize, and make thumbnails of images.","error-rename":"File name already in use!","error-file-name":"File name cannot be empty!","error-file-empty":"You must choose a file!","error-file-exist":"A file with this name already exists!","error-file-size":"File size exceeds server limit! (maximum size: :max)","error-delete-folder":"You cannot delete this folder because it is not empty!","error-folder-name":"Folder name cannot be empty!","error-folder-exist":"A folder with this name already exists!","error-folder-alnum":"Only alphanumeric folder names are allowed!","error-folder-not-found":"Folder  not found! (:folder)","error-mime":"Unexpected MimeType: ","error-size":"Over limit size:","error-instance":"The uploaded file should be an instance of UploadedFile","error-invalid":"Invalid upload request","error-other":"An error has occured: ","error-too-large":"Request entity too large!","btn-upload":"Upload File(s)","btn-uploading":"Uploading...","btn-close":"Close","btn-crop":"Crop","btn-cancel":"Cancel","btn-resize":"Resize","resize-ratio":"Ratio:","resize-scaled":"Image scaled:","resize-true":"Yes","resize-old-height":"Original Height:","resize-old-width":"Original Width:","resize-new-height":"Height:","resize-new-width":"Width:","locale-bootbox":"en"},"vi.admin.search":{"search":"T\u00ecm ki\u1ebfm","keyword":"T\u1eeb kh\u00f3a","status":"Tr\u1ea1ng th\u00e1i","type":"Lo\u1ea1i","parent":"Danh m\u1ee5c cha","rank":"C\u1ea5p \u0111\u1ed9","role":"Quy\u1ec1n h\u1ea1n","object":"\u0110\u1ed1i t\u01b0\u1ee3ng","user":"Ng\u01b0\u1eddi d\u00f9ng","article":"B\u00e0i vi\u1ebft","document":"T\u00e0i li\u1ec7u","placeholder":{"input":":input","choice":"---Ch\u1ecdn :choice---"},"btn":{"search":"T\u00ecm ki\u1ebfm","cancel":"H\u1ee7y"},"input":{"category":"T\u00ean, M\u00f4 t\u1ea3","user":"T\u00ean, T\u00ean \u0111\u0103ng nh\u1eadp, Email, S\u1ed1 \u0111i\u1ec7n tho\u1ea1i, Li\u00ean k\u1ebft","document":"T\u00ean, T\u00ean \u0111\u1ecbnh danh, M\u00f4 t\u1ea3, File, Li\u00ean k\u1ebft","comment":"N\u1ed9i dung"},"choice":{"parent":"danh m\u1ee5c cha","status":"tr\u1ea1ng th\u00e1i","type":"lo\u1ea1i","rank":"c\u1ea5p \u0111\u1ed9","role":"quy\u1ec1n h\u1ea1n","object":"\u0111\u1ed1i t\u01b0\u1ee3ng","user":"ng\u01b0\u1eddi d\u00f9ng","article":"b\u00e0i vi\u1ebft","document":"t\u00e0i li\u1ec7u"}},"vi.admin.category":{"list":"Danh s\u00e1ch danh m\u1ee5c","create":"T\u1ea1o m\u1ed9t danh m\u1ee5c","edit":"Ch\u1ec9nh s\u1eeda m\u1ed9t danh m\u1ee5c","detail":"Chi ti\u1ebft danh m\u1ee5c","table_head":["STT","T\u00ean","M\u00f4 t\u1ea3","H\u00ecnh \u1ea3nh","Danh m\u1ee5c cha"],"table_head_width":["w-50","w-200","w-350","w-100","w-200"],"placeholder":{"name":"Nh\u1eadp t\u00ean","description":"Nh\u1eadp m\u00f4 t\u1ea3","parent":"Ch\u1ecdn danh m\u1ee5c cha"},"button":{"save":"L\u01b0u","close":"\u0110\u00f3ng","back":"Quay l\u1ea1i","add_new":"Th\u00eam ti\u1ebfp t\u1ee5c"},"info":{"parent":"Th\u00f4ng tin danh m\u1ee5c cha","name":"T\u00ean","description":"M\u00f4 t\u1ea3","image":"H\u00ecnh \u1ea3nh"}},"vi.admin.user":{"list":"Danh s\u00e1ch ng\u01b0\u1eddi d\u00f9ng","create":"T\u1ea1o ng\u01b0\u1eddi d\u00f9ng","edit":"Ch\u1ec9nh s\u1eeda ng\u01b0\u1eddi d\u00f9ng","detail":"Chi ti\u1ebft ng\u01b0\u1eddi d\u00f9ng","table_head":["STT","T\u00ean \u0111\u0103ng nh\u1eadp","Email","S\u1ed1 \u0111i\u1ec7n tho\u1ea1i","C\u1ea5p \u0111\u1ed9","Quy\u1ec1n h\u1ea1n"],"table_head_width":["w-50","w-200","w-200","w-100","w-100","w-150"],"placeholder":{"fullname":"Nh\u1eadp t\u00ean \u0111\u1ea7y \u0111\u1ee7","nickname":"Nh\u1eadp t\u00ean \u0111\u0103ng nh\u1eadp","email":"Nh\u1eadp email","password":"Nh\u1eadp m\u1eadt kh\u1ea9u","phone":"Nh\u1eadp s\u1ed1 \u0111i\u1ec7n tho\u1ea1i","facebook_link":"Nh\u1eadp li\u00ean k\u1ebft facebook","linkedin_link":"Nh\u1eadp li\u00ean k\u1ebft linkedin","github_link":"Nh\u1eadp li\u00ean k\u1ebft github","stackoverflow_link":"Nh\u1eadp li\u00ean k\u1ebft stackoverflow","status":"B\u1ea1n c\u00f3 mu\u1ed1n chia s\u1ebb th\u00f4ng tin(s\u1ed1 \u0111i\u1ec7n tho\u1ea1i, email, ..)?","status_public":"C\u00f3","status_private":"Kh\u00f4ng"},"button":{"save":"L\u01b0u","close":"\u0110\u00f3ng","back":"Quay l\u1ea1i","add_new":"Th\u00eam ti\u1ebfp t\u1ee5c"},"info":{"fullname":"T\u00ean \u0111\u1ea7y \u0111\u1ee7","nickname":"T\u00ean \u0111\u0103ng nh\u00e2p","email":"Email","password":"M\u1eadt kh\u1ea9u","phone":"S\u1ed1 \u0111i\u1ec7n tho\u1ea1i","facebook_link":"Facebook","linkedin_link":"Linkedin","github_link":"Github","stackoverflow_link":"Stackoverflow","status":"Tr\u1ea1ng th\u00e1i","rank":"C\u1ea5p \u0111\u1ed9","role":"Quy\u1ec1n h\u1ea1n"},"status":["Kh\u00f4ng hi\u1ec7n th\u00f4ng tin","Hi\u1ec7n th\u00f4ng tin"],"rank":["Ch\u01b0a c\u00f3","B\u1ea1ch kim","V\u00e0ng","B\u1ea1c","\u0110\u1ed3ng"],"role":["Ch\u01b0a x\u00e1c \u0111\u1ecbnh","Qu\u1ea3n l\u00fd","Ng\u01b0\u1eddi d\u00f9ng c\u1ea5p cao","Ng\u01b0\u1eddi d\u00f9ng"]},"vi.admin.master":{"sidebar":{"item":":item","list":"Danh s\u00e1ch","create":"T\u1ea1o m\u1edbi"},"info":{"name":"Admin","status":"Tr\u1ef1c truy\u1ebfn"},"items":{"user":"Ng\u01b0\u1eddi d\u00f9ng","category":"Danh m\u1ee5c","article":"B\u00e0i vi\u1ebft","session":"Kh\u00f3a h\u1ecdc","document":"T\u00e0i li\u1ec7u","comment":"B\u00ecnh lu\u1eadn"}},"vi.admin.comment":{"list":"Danh s\u00e1ch b\u00ecnh lu\u1eadn","edit":"Ch\u1ec9nh s\u1eeda b\u00ecnh lu\u1eadn","detail":"Chi ti\u1ebft b\u00ecnh lu\u1eadn","table_head":["STT","N\u1ed9i dung","Ng\u01b0\u1eddi BL","Lo\u1ea1i","\u0110\u1ed1i t\u01b0\u1ee3ng","Tr\u1ea1ng th\u00e1i"],"table_head_width":["w-50","w-200","w-150","w-100","w-200","w-150"],"placeholder":{"content":"Nh\u1eadp n\u1ed9i dung","type":"Ch\u1ecdn lo\u1ea1i","object":"Ch\u1ecdn \u0111\u1ed1i t\u01b0\u1ee3ng","status":"Ch\u1ecdn tr\u1ea1ng th\u00e1i"},"button":{"save":"L\u01b0u","close":"\u0110\u00f3ng","back":"Quay l\u1ea1i"},"info":{"content":"N\u1ed9i dung","type":"Lo\u1ea1i","object":"\u0110\u1ed1i t\u01b0\u1ee3ng","article":"B\u00e0i vi\u1ebft","document":"T\u00e0i li\u1ec7u","waiting":"\u0110ang \u0111\u1ee3i","public":"\u0110\u00e3 duy\u1ec7t","cancel":"\u0110\u00e3 h\u1ee7y","status":"Tr\u1ea1ng th\u00e1i","user":"Ng\u01b0\u1eddi b\u00ecnh lu\u1eadn"},"type":["Kh\u00f4ng x\u00e1c \u0111\u1ecbnh","B\u00e0i vi\u1ebft","T\u00e0i li\u1ec7u"],"status":["Kh\u00f4ng x\u00e1c \u0111\u1ecbnh","\u0110ang \u0111\u1ee3i","\u0110\u00e3 duy\u1ec7t","\u0110\u00e3 h\u1ee7y"]},"vi.admin.document":{"list":"Danh s\u00e1ch t\u00e0i li\u1ec7u","create":"T\u1ea1o t\u00e0i li\u1ec7u","edit":"Ch\u1ec9nh s\u1eeda t\u00e0i li\u1ec7u","detail":"Chi ti\u1ebft t\u00e0i li\u1ec7u","table_head":["STT","T\u00ean","T\u00e0i li\u1ec7u","Tr\u1ea1ng th\u00e1i","Ng\u01b0\u1eddi t\u1ea1o"],"table_head_width":["w-50","w-200","w-200","w-100","w-150"],"placeholder":{"name":"Nh\u1eadp t\u00ean","alias":"Nh\u1eadp \u0111\u1ecbnh danh","description":"Nh\u1eadp m\u00f4 t\u1ea3","link":"Nh\u1eadp li\u00ean k\u1ebft","file":"T\u1ea3i file"},"button":{"save":"L\u01b0u","close":"\u0110\u00f3ng","back":"Quay l\u1ea1i","add_new":"Th\u00eam ti\u1ebfp t\u1ee5c"},"info":{"name":"T\u00ean","description":"M\u00f4 t\u1ea3","file":"File","link":"Link","status":"Tr\u1ea1ng th\u00e1i","user":"Ng\u01b0\u1eddi t\u1ea1o","alias":"T\u00ean \u0111\u1ecbnh danh"},"status":["Kh\u00f4ng x\u00e1c \u0111\u1ecbnh","\u0110ang \u0111\u1ee3i","\u0110\u00e3 duy\u1ec7t","\u0110\u00e3 h\u1ee7y"]},"vi.message":{"info":{"not_items_in_list":"Kh\u00f4ng t\u00ecm th\u1ea5y k\u1ebft qu\u1ea3 n\u00e0o"},"warning":[],"success":{"create":"T\u1ea1o m\u1ed9t :item th\u00e0nh c\u00f4ng","update":"C\u1eadp nh\u1eadt m\u1ed9t :item th\u00e0nh c\u00f4ng","delete":"X\u00f3a :item th\u00e0nh c\u00f4ng","ajax":"X\u1eed l\u00fd th\u00e0nh c\u00f4ng","deleteMultiple":"X\u00f3a th\u00e0nh c\u00f4ng"},"danger":{"create":"T\u1ea1o m\u1ed9t :item th\u1ea5t b\u1ea1i","update":"C\u1eadp nh\u1eadt m\u1ed9t :item th\u1ea5t b\u1ea1i","delete":"X\u00f3a :item th\u1ea5t b\u1ea1i","not_found":"Kh\u00f4ng t\u00ecm th\u1ea5y :item n\u00e0y","download":"Kh\u00f4ng th\u1ec3 t\u1ea3i v\u1ec1 file n\u00e0y","ajax":"X\u1eed l\u00fd th\u1ea5t b\u1ea1i","deleteMultiple":"X\u00f3a th\u1ea5t b\u1ea1i"},"confirm":{"delete":"B\u1ea1n c\u00f3 mu\u1ed1n x\u00f3a :item n\u00e0y?"},"items":{"category":"danh m\u1ee5c","user":"ng\u01b0\u1eddi d\u00f9ng","document":"t\u00e0i li\u1ec7u","comment":"b\u00ecnh lu\u1eadn"}},"vi.general":{"label":{"search":"T\u00ecm Ki\u1ebfm","keyword":"T\u1eeb kh\u00f3a","status":"Tr\u1ea1ng th\u00e1i","list":"Danh s\u00e1ch","stt":"STT","edit":"S\u1eeda","detail":"Chi ti\u1ebft","delete":"X\u00f3a","name":"T\u00ean","alias":"Alias","description":"M\u00f4 t\u1ea3","content":"N\u1ed9i dung","image":"H\u00ecnh \u1ea3nh","author":"T\u00e1c gi\u1ea3","function":"Ch\u1ee9c n\u0103ng","no_results":"Kh\u00f4ng c\u00f3 k\u1ebft qu\u1ea3","create_new":"T\u1ea1o m\u1edbi","category":"Danh m\u1ee5c","lesson":"B\u00e0i h\u1ecdc","update":"C\u1eadp nh\u1eadt","count_share":"L\u01b0\u1ee3t chia s\u1ebb","time_tracking":"Th\u1eddi gian l\u00e0m b\u00e0i","waiting":"\u0110ang ch\u1edd","public":"C\u00f4ng khai","cancel":"H\u1ee7y","blog":"Blog","yes":"C\u00f3","no":"Kh\u00f4ng","questions_list":"Danh s\u00e1ch c\u00e2u h\u1ecfi","question":"C\u00e2u h\u1ecfi","add_question":"Th\u00eam c\u00e2u h\u1ecfi","add_answer":"Th\u00eam \u0111\u00e1p \u00e1n","answer":"\u0110\u00e1p \u00e1n","explain":"Gi\u1ea3i th\u00edch"},"btn":{"cancel":"H\u1ee7y","search":"T\u00ecm Ki\u1ebfm","save":"L\u01b0u","back":"Quay l\u1ea1i"}},"vi.passwords":{"password":"M\u1eadt kh\u1ea9u ph\u1ea3i g\u1ed3m 6 k\u00fd t\u1ef1 v\u00e0 kh\u1edbp v\u1edbi ph\u1ea7n x\u00e1c nh\u1eadn.","reset":"M\u1eadt kh\u1ea9u m\u1edbi \u0111\u00e3 \u0111\u01b0\u1ee3c c\u1eadp nh\u1eadt!","sent":"H\u01b0\u1edbng d\u1eabn c\u1ea5p l\u1ea1i m\u1eadt kh\u1ea9u \u0111\u00e3 \u0111\u01b0\u1ee3c g\u1eedi!","token":"M\u00e3 c\u1ea5p l\u1ea1i m\u1eadt kh\u1ea9u kh\u00f4ng h\u1ee3p l\u1ec7.","user":"Kh\u00f4ng t\u00ecm th\u1ea5y ng\u01b0\u1eddi d\u00f9ng v\u1edbi \u0111\u1ecba ch\u1ec9 email n\u00e0y."},"vi.auth":{"failed":"Th\u00f4ng tin t\u00e0i kho\u1ea3n kh\u00f4ng t\u00ecm th\u1ea5y trong h\u1ec7 th\u1ed1ng.","throttle":"V\u01b0\u1ee3t qu\u00e1 s\u1ed1 l\u1ea7n \u0111\u0103ng nh\u1eadp cho ph\u00e9p. Vui l\u00f2ng th\u1eed l\u1ea1i sau :seconds gi\u00e2y.","email_password_invalid":"Email m\u1eadt kh\u1ea9u kh\u00f4ng h\u1ee3p l\u1ec7"},"vi.ajax":{"delete_multiple":{"objectAjax":{"required":"\u0110\u1ed1i t\u01b0\u1ee3ng x\u00f3a kh\u00f4ng h\u1ee3p l\u1ec7"},"dataAjax":{"required":"D\u1eef li\u1ec7u kh\u00f4ng h\u1ee3p l\u1ec7","array":"D\u1eef li\u1ec7u ph\u1ea3i l\u00e0 m\u1ed9t m\u1ea3ng","exists":"D\u1eef li\u1ec7u :value kh\u00f4ng c\u00f3 trong c\u01a1 s\u1edf d\u1eef li\u1ec7u"},"not_choice_item":"Kh\u00f4ng c\u00f3 d\u1eef li\u1ec7u \u0111\u01b0\u1ee3c ch\u1ecdn","confirm":"B\u1ea1n mu\u1ed1n x\u00f3a c\u00e1c m\u1ee5c n\u00e0y?"}},"vi.pagination":{"previous":"&laquo; Trang sau","next":"Trang tr\u01b0\u1edbc &raquo;"}});})();