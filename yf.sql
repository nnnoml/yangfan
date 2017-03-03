-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 192.168.1.26
-- Generation Time: 2017-03-03 11:23:48
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yf`
--

-- --------------------------------------------------------

--
-- 表的结构 `leee_admin`
--

CREATE TABLE IF NOT EXISTS `leee_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `last_login_ip` varchar(15) NOT NULL,
  `login_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `leee_admin`
--

INSERT INTO `leee_admin` (`id`, `name`, `pwd`, `salt`, `last_login_ip`, `login_count`, `created_at`, `updated_at`) VALUES
(1, 'a', '9e9f9b5b6e02cf22550042effd00526f', '58b50c23523ca', '127.0.0.1', 13, '2017-02-27 09:07:37', '2017-03-03 01:12:35'),
(2, 'admin111111', '593d9b516b0a9045a446cae14d356c39', '58b3ec38552b0', '127.0.0.1', 1, '2017-02-28 02:28:09', '2017-02-28 02:28:09');

-- --------------------------------------------------------

--
-- 表的结构 `leee_buy_shops`
--

CREATE TABLE IF NOT EXISTS `leee_buy_shops` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺编号',
  `name` varchar(100) NOT NULL COMMENT '店铺名称',
  `user_wechat` varchar(50) NOT NULL COMMENT '分账用户微信号',
  `area` varchar(30) NOT NULL COMMENT '坐标',
  `start_time` varchar(10) NOT NULL COMMENT '开始时间',
  `end_time` varchar(10) NOT NULL COMMENT '结束时间',
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `leee_buy_shops`
--

INSERT INTO `leee_buy_shops` (`id`, `name`, `user_wechat`, `area`, `start_time`, `end_time`, `updated_at`, `created_at`) VALUES
(1, '绿地领海', '', '116.622162,40.019117', '00:00:00', '23:59:59', '2017-03-03 01:16:14', '2017-03-01 05:51:12'),
(2, '至尊网络', '', '1', '', '', '2017-03-03 01:13:25', '2017-03-03 01:13:25');

-- --------------------------------------------------------

--
-- 表的结构 `leee_conf`
--

CREATE TABLE IF NOT EXISTS `leee_conf` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '店铺名称',
  `AppID` varchar(50) NOT NULL COMMENT '微信appid',
  `AppSecret` varchar(50) NOT NULL COMMENT '微信秘钥',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `leee_conf`
--

INSERT INTO `leee_conf` (`id`, `title`, `AppID`, `AppSecret`, `created_at`, `updated_at`) VALUES
(2, 'ttt', 'wx0095a618c5b767ae', '', '2017-02-28 06:06:50', '2017-02-28 06:06:50');

-- --------------------------------------------------------

--
-- 表的结构 `leee_order`
--

CREATE TABLE IF NOT EXISTS `leee_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` mediumint(9) NOT NULL COMMENT '用户id',
  `order_id` varchar(50) NOT NULL COMMENT '订单号',
  `bs_id` mediumint(8) unsigned NOT NULL COMMENT '购买商铺id',
  `g_id` int(11) NOT NULL COMMENT '商品id',
  `ss_id` mediumint(8) unsigned NOT NULL COMMENT '销售商铺id',
  `relation_id` mediumint(8) unsigned NOT NULL COMMENT '对应关系id',
  `order_num` int(10) unsigned NOT NULL COMMENT '订单数量',
  `order_single_price` int(10) unsigned NOT NULL COMMENT '商品单价',
  `order_cash` int(10) unsigned NOT NULL COMMENT '订单价格',
  `machine_num` varchar(10) NOT NULL COMMENT '机器编号',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '是否支付成功',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `leee_order`
--

INSERT INTO `leee_order` (`id`, `u_id`, `order_id`, `bs_id`, `g_id`, `ss_id`, `relation_id`, `order_num`, `order_single_price`, `order_cash`, `machine_num`, `created_at`, `updated_at`, `status`) VALUES
(3, 2, '58b91cea98fb922048', 1, 3, 3, 9, 1, 0, 11155, '11v', '2017-03-03 07:36:10', '2017-03-03 07:36:10', 1),
(7, 2, '58b924eb2359224256', 1, 3, 3, 9, 1, 11155, 11155, 'mc大队长', '2017-03-03 08:10:19', '2017-03-03 08:10:19', 0),
(9, 2, '58b9265a1a11726357', 1, 1, 3, 9, 9, 1011, 9099, 'mc子龙', '2017-03-03 08:16:26', '2017-03-03 08:16:26', 0);

-- --------------------------------------------------------

--
-- 表的结构 `leee_sell_goods`
--

CREATE TABLE IF NOT EXISTS `leee_sell_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品',
  `s_id` mediumint(8) unsigned NOT NULL COMMENT '关联销售商铺的id',
  `p_id` int(11) NOT NULL COMMENT '暂时图片id',
  `name` varchar(100) NOT NULL COMMENT '商品名称',
  `desc` text NOT NULL COMMENT '描述',
  `price` int(10) unsigned NOT NULL COMMENT '单价,精确到分',
  `max_num` int(11) NOT NULL COMMENT '每天最大销售数',
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否上线销售',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `leee_sell_goods`
--

INSERT INTO `leee_sell_goods` (`id`, `s_id`, `p_id`, `name`, `desc`, `price`, `max_num`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '奔跑鸡', '奔跑鸡奔跑鸡奔跑鸡奔跑鸡', 1011, -1, '01:00:00', '23:00:00', 1, '2017-03-01 03:18:49', '2017-03-01 03:18:49'),
(3, 3, 1, '可乐鸡', '产品描述223', 11155, 0, '', '', 1, '2017-03-01 03:23:20', '2017-03-03 08:10:19');

-- --------------------------------------------------------

--
-- 表的结构 `leee_sell_goods_img`
--

CREATE TABLE IF NOT EXISTS `leee_sell_goods_img` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `g_id` mediumint(9) unsigned NOT NULL COMMENT '关联商品id',
  `name` varchar(50) NOT NULL COMMENT '图片名称',
  `url` varchar(100) NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `leee_sell_shops`
--

CREATE TABLE IF NOT EXISTS `leee_sell_shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '销售店铺id',
  `name` varchar(100) NOT NULL COMMENT '销售店铺名称',
  `user_wechat` varchar(50) NOT NULL COMMENT '分账用户微信号',
  `area` varchar(30) NOT NULL COMMENT '坐标',
  `start_time` varchar(10) NOT NULL COMMENT '开始时间',
  `end_time` varchar(10) NOT NULL COMMENT '结束时间',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `leee_sell_shops`
--

INSERT INTO `leee_sell_shops` (`id`, `name`, `user_wechat`, `area`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '哈哈哈', '', 'asdf', '0000-00-00', '0000-00-00', '2017-02-28 08:55:02', '2017-03-01 01:57:29'),
(2, '新增店铺1', '', '123', '0000-00-00', '0000-00-00', '2017-03-01 02:03:33', '2017-03-01 02:04:45'),
(3, 'i都会', '', '116.338153,39.988609', '0000-00-00', '0000-00-00', '2017-03-01 02:03:55', '2017-03-01 02:03:55'),
(4, 'ddd', '', '116.338153,39.988609', '0000-00-00', '0000-00-00', '2017-03-01 02:04:56', '2017-03-01 02:04:56'),
(5, '绿地领海', '', '116.557771,39.991705', '', '', '2017-03-01 05:45:48', '2017-03-01 05:45:48'),
(6, '11', '', '222', '03:00:00', '14:00:00', '2017-03-01 05:46:46', '2017-03-01 05:46:46'),
(7, '123', '', '123', '', '', '2017-03-01 05:49:49', '2017-03-01 05:49:49');

-- --------------------------------------------------------

--
-- 表的结构 `leee_shops_relation`
--

CREATE TABLE IF NOT EXISTS `leee_shops_relation` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `qr_id` varchar(32) NOT NULL COMMENT 'qrcodeid',
  `bs_id` mediumint(8) unsigned NOT NULL COMMENT '购买商铺id',
  `ss_id` mediumint(8) unsigned NOT NULL COMMENT '销售商铺id',
  `sale_id` mediumint(8) unsigned NOT NULL COMMENT '打折策略id',
  `status` tinyint(1) NOT NULL COMMENT '是否启用',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `leee_shops_relation`
--

INSERT INTO `leee_shops_relation` (`id`, `qr_id`, `bs_id`, `ss_id`, `sale_id`, `status`, `created_at`, `updated_at`) VALUES
(9, '58b8c363eb4a19', 1, 3, 0, 1, '2017-03-03 01:14:11', '2017-03-03 01:42:09'),
(10, '58b8c36d7cd3b10', 2, 5, 0, 1, '2017-03-03 01:14:21', '2017-03-03 01:14:21');

-- --------------------------------------------------------

--
-- 表的结构 `leee_user`
--

CREATE TABLE IF NOT EXISTS `leee_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL COMMENT '用户微信openid',
  `nick` varchar(50) NOT NULL COMMENT '用户昵称',
  `avatar` varchar(255) NOT NULL COMMENT '玩家头像',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '该玩家是否可以分账，默认不可以',
  `reserve_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '预定次数',
  `reserve_price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '预定金额',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `leee_user`
--

INSERT INTO `leee_user` (`id`, `openid`, `nick`, `avatar`, `status`, `reserve_num`, `reserve_price`, `created_at`, `updated_at`) VALUES
(1, '12313123sdasafsdf', 'charis', 'http://image.phpcomposer.com/d/1e/768684492400b1470aa7882b29d5c.png', 1, 0, 0, '2017-03-02 03:48:10', '2017-03-02 05:15:18'),
(2, '12313123sdasafsdf', 'charis', 'http://image.phpcomposer.com/d/1e/768684492400b1470aa7882b29d5c.png', 0, 0, 0, '2017-03-02 03:48:37', '2017-03-02 03:48:37');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
