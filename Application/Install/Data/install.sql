-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-19 20:47:00
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lcm`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_article`
--

DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE IF NOT EXISTS `blog_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(40) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `pic` varchar(300) NOT NULL COMMENT '图片',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `fid` int(11) NOT NULL COMMENT '分类ID',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `edittime` int(11) NOT NULL COMMENT '修改时间',
  `view` int(11) NOT NULL COMMENT '查看次数',
  `status` int(11) NOT NULL COMMENT '当前状态',
  `mp3` varchar(200) DEFAULT NULL,
  `istop` int(11) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `viewtumb` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示封面 0显示 1不显示',
  `articlepassword` varchar(50) DEFAULT NULL COMMENT '文章查看密码',
  `video` varchar(500) DEFAULT NULL COMMENT '视频连接',
  `file` varchar(500) DEFAULT NULL COMMENT '附件地址',
  `type` int(11) NOT NULL COMMENT '文章样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `blog_article`
--

TRUNCATE TABLE `blog_article`;
-- --------------------------------------------------------

--
-- 表的结构 `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30) NOT NULL COMMENT '分类名称',
  `fid` int(11) NOT NULL COMMENT '父级ID',
  `type` int(11) NOT NULL COMMENT '分类样式',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '分类排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分类表' AUTO_INCREMENT=22 ;

--
-- 插入之前先把表清空（truncate） `blog_category`
--

TRUNCATE TABLE `blog_category`;
--
-- 转存表中的数据 `blog_category`
--

INSERT INTO `blog_category` (`id`, `name`, `fid`, `type`, `sort`) VALUES
(1, '技术', 0, 1, 0),
(2, 'PHP', 1, 5, 0),
(3, '音乐', 0, 1, 200),
(8, 'Css', 1, 3, 1),
(10, '音乐分享', 3, 2, 0),
(20, '流行音乐', 10, 1, 0),
(21, '我的流行', 20, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `blog_code`
--

DROP TABLE IF EXISTS `blog_code`;
CREATE TABLE IF NOT EXISTS `blog_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL COMMENT '邀请码',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态 0未使用 1 使用',
  `user` varchar(40) DEFAULT NULL COMMENT '使用用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='邀请码' AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `blog_code`
--

TRUNCATE TABLE `blog_code`;
-- --------------------------------------------------------

--
-- 表的结构 `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '评论者姓名',
  `email` varchar(30) NOT NULL COMMENT '评论者邮箱',
  `content` varchar(200) NOT NULL COMMENT '评论者内容',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '评论者ID',
  `replay` int(11) DEFAULT NULL COMMENT '评论谁',
  `ctime` int(11) NOT NULL COMMENT '评论时间',
  `aid` int(11) NOT NULL COMMENT '文章ID',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态 0显示 1不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `blog_comment`
--

TRUNCATE TABLE `blog_comment`;
-- --------------------------------------------------------

--
-- 表的结构 `blog_email_set`
--

DROP TABLE IF EXISTS `blog_email_set`;
CREATE TABLE IF NOT EXISTS `blog_email_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smtpserver` varchar(200) NOT NULL COMMENT 'SMTP服务器',
  `smtpserverport` int(11) NOT NULL COMMENT 'SMTP服务器端口',
  `smtpusermail` varchar(200) NOT NULL COMMENT 'SMTP服务器的用户邮箱',
  `smtpuser` varchar(200) NOT NULL COMMENT 'SMTP服务器的用户帐号',
  `smtppass` varchar(200) NOT NULL COMMENT 'SMTP服务器的用户密码',
  `reg_set_admin` int(11) NOT NULL COMMENT '用户注册 管理员是否收到邮件 0是 1不是',
  `send_article_set` int(11) NOT NULL COMMENT '用户发表文章  管理员是否收到邮件 0是 1 不是',
  `comment_set` int(11) NOT NULL COMMENT '用户回复 管理员是否收到邮件 0是 1不是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='邮件设置' AUTO_INCREMENT=2 ;

--
-- 插入之前先把表清空（truncate） `blog_email_set`
--

TRUNCATE TABLE `blog_email_set`;
--
-- 转存表中的数据 `blog_email_set`
--

INSERT INTO `blog_email_set` (`id`, `smtpserver`, `smtpserverport`, `smtpusermail`, `smtpuser`, `smtppass`, `reg_set_admin`, `send_article_set`, `comment_set`) VALUES
(1, 'smtp.163.com', 25, 'zhaodong1475@163.com', 'zhaodong1475@163.com', 'zxc123456', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `blog_email_type`
--

DROP TABLE IF EXISTS `blog_email_type`;
CREATE TABLE IF NOT EXISTS `blog_email_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_user_title` varchar(200) NOT NULL COMMENT '用户注册用户收到邮件的标题',
  `reg_user_content` text NOT NULL COMMENT '用户注册用户收到邮件的内容',
  `reg_admin_title` varchar(200) NOT NULL COMMENT '用户注册管理员收到邮件的标题',
  `reg_admin_content` text NOT NULL COMMENT '用户注册管理员收到邮件的内容',
  `send_article_title` varchar(200) NOT NULL COMMENT '用户发文章管理员收到邮件的标题',
  `send_article_content` text NOT NULL COMMENT '用户发文章管理员收到邮件的内容',
  `send_comment_title` varchar(200) NOT NULL COMMENT '用户评论管理员收到邮件的标题',
  `send_comment_content` text NOT NULL COMMENT '用户评论管理员收到邮件的内容',
  `send_message_title` varchar(200) NOT NULL COMMENT '用户收到留言用户邮件的标题',
  `send_message_content` text NOT NULL COMMENT '用户收到留言用户邮件内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='邮件模板' AUTO_INCREMENT=2 ;

--
-- 插入之前先把表清空（truncate） `blog_email_type`
--

TRUNCATE TABLE `blog_email_type`;
--
-- 转存表中的数据 `blog_email_type`
--

INSERT INTO `blog_email_type` (`id`, `reg_user_title`, `reg_user_content`, `reg_admin_title`, `reg_admin_content`, `send_article_title`, `send_article_content`, `send_comment_title`, `send_comment_content`, `send_message_title`, `send_message_content`) VALUES
(1, '恭喜您注册本站', '<p></p><p></p><p>恭喜您注册本站<strong></strong><br/></p><p></p><p></p>', '有人注册本网站了', '<p></p><p></p><p>有人注册本网站了</p><p></p><p></p>', '有人发表文章了呦', '<p></p><p></p><p></p><p>有人发表文章了呦</p><p></p><p></p><p></p>', '亲爱的管理员 有人评论文章了呦11122', '<p></p><p></p><p></p><p></p><p></p><p>有人评论啦</p><p></p><p></p><p></p><p></p><p></p>', '亲爱的管理员有用户留言了啊！', '<p></p><p></p>有人留言啦<p></p><p></p>');

-- --------------------------------------------------------

--
-- 表的结构 `blog_friendlink`
--

DROP TABLE IF EXISTS `blog_friendlink`;
CREATE TABLE IF NOT EXISTS `blog_friendlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(30) NOT NULL COMMENT '标题',
  `content` varchar(200) NOT NULL COMMENT '描述',
  `ctime` int(11) NOT NULL COMMENT '时间',
  `url` varchar(100) NOT NULL COMMENT '链接',
  `type` varchar(20) NOT NULL COMMENT '样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='友情链接' AUTO_INCREMENT=24 ;

--
-- 插入之前先把表清空（truncate） `blog_friendlink`
--

TRUNCATE TABLE `blog_friendlink`;
--
-- 转存表中的数据 `blog_friendlink`
--

INSERT INTO `blog_friendlink` (`id`, `title`, `content`, `ctime`, `url`, `type`) VALUES
(1, '斗图啊', '斗图啊是一个在线制作搞笑表情的网站', 1454596882, 'http://www.doutua.com/', 'info'),
(23, '里程密', '里程密开源PHP博客系统', 1454596882, 'http://www.lcm.wang/', 'info');

-- --------------------------------------------------------

--
-- 表的结构 `blog_site`
--

DROP TABLE IF EXISTS `blog_site`;
CREATE TABLE IF NOT EXISTS `blog_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(200) NOT NULL COMMENT '网站标题',
  `keywords` text NOT NULL COMMENT '网站关键字',
  `description` text NOT NULL COMMENT '网站描述',
  `logo` varchar(200) NOT NULL COMMENT '网站LOGO',
  `articleSatus` int(11) NOT NULL COMMENT '0 无需审核 1 需要审核',
  `userStatus` int(11) NOT NULL COMMENT '0无需注册码 1需要注册码',
  `admin_email` varchar(100) NOT NULL COMMENT '管理员邮箱',
  `set_content` varchar(50) NOT NULL COMMENT '副标题',
  `name` varchar(50) NOT NULL COMMENT '网站名称',
  `statistics` text NOT NULL COMMENT '网站统计代码',
  `code` text NOT NULL COMMENT '邀请码说明',
  `friend_link` text NOT NULL COMMENT '友情链接说明',
  `icp` varchar(600) NOT NULL COMMENT 'ICP备案号',
  `submission` int(11) NOT NULL COMMENT '是否可以投稿 0可以 1不可以',
  `slides_display` int(11) NOT NULL COMMENT '是否显示幻灯片 0显示 1不显示',
  `file_size` int(11) NOT NULL COMMENT '文件大小限制',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='网站设置' AUTO_INCREMENT=2 ;

--
-- 插入之前先把表清空（truncate） `blog_site`
--

TRUNCATE TABLE `blog_site`;
--
-- 转存表中的数据 `blog_site`
--

INSERT INTO `blog_site` (`id`, `title`, `keywords`, `description`, `logo`, `articleSatus`, `userStatus`, `admin_email`, `set_content`, `name`, `statistics`, `code`, `friend_link`, `icp`, `submission`, `slides_display`, `file_size`) VALUES
(1, '里程密开源博客系统', '里程密|ThinkPHP开源博客系统456', '这里是一个网站描述11asd', './Public/Uploads/2016-10-13/57ffa703be1db.jpg', 1, 0, '731371050@qq.com', '阿萨德阿萨德1', '里程密', '<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=''cnzz_stat_icon_1256104530''%3E%3C/span%3E%3Cscript src=''" + cnzz_protocol + "s11.cnzz.com/stat.php%3Fid%3D1256104530'' type=''text/javascript''%3E%3C/script%3E"));</script>', '正如本站的名称一样，里程密，一个程序员里程的秘密，所以我们更希望这里是一个和谐干净的程序员呆的地方，\r\n而不希望这里像菜市场一样杂乱无章. ', '使用里程密开源博客系统 并且保持友情链接的网站 可以获得本站邀请码一枚和友情链接\r\n请把你的网站发送给管理员邮箱:lcm1475@aliyun.com 或者把你的网站信息发送给群主\r\n稍后就会添加上你网站的友情链接 ', '<a href = "www.baidu.com">asd</a>', 0, 0, 8);

-- --------------------------------------------------------

--
-- 表的结构 `blog_slides`
--

DROP TABLE IF EXISTS `blog_slides`;
CREATE TABLE IF NOT EXISTS `blog_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `url` varchar(100) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='幻灯片' AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `blog_slides`
--

TRUNCATE TABLE `blog_slides`;
-- --------------------------------------------------------

--
-- 表的结构 `blog_user`
--

DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(40) NOT NULL COMMENT '用户账号',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `pic` varchar(200) NOT NULL COMMENT '用户头像',
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `lasttime` int(11) NOT NULL COMMENT '上次登录时间',
  `ip` varchar(50) NOT NULL COMMENT '注册IP地址',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态 0启用 1禁用',
  `truename` varchar(30) NOT NULL DEFAULT '里程密' COMMENT '昵称',
  `admin` int(11) NOT NULL DEFAULT '0' COMMENT '是否是管理员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `blog_user`
--

TRUNCATE TABLE `blog_user`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
