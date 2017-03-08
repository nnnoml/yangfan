-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 192.168.1.26
-- Generation Time: 2017-03-08 11:08:02
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
(1, 'a', '9e9f9b5b6e02cf22550042effd00526f', '58b50c23523ca', '127.0.0.1', 17, '2017-02-27 09:07:37', '2017-03-08 06:26:42'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `leee_buy_shops`
--

INSERT INTO `leee_buy_shops` (`id`, `name`, `user_wechat`, `area`, `start_time`, `end_time`, `updated_at`, `created_at`) VALUES
(1, '至尊网路', 'ogXult077N4Dp_Tbd3dWp0UPyEY4', '12', '', '', '2017-03-07 06:53:09', '2017-03-07 06:52:32');

-- --------------------------------------------------------

--
-- 表的结构 `leee_cash_flow`
--

CREATE TABLE IF NOT EXISTS `leee_cash_flow` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL COMMENT '订单号',
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `price` int(10) unsigned NOT NULL COMMENT '入账金额',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `leee_cash_flow`
--

INSERT INTO `leee_cash_flow` (`id`, `order_id`, `user_id`, `price`, `created_at`, `updated_at`) VALUES
(1, '58be5a080c13d63503', 6, 1000, '2017-03-07 07:19:11', '2017-03-07 07:19:11'),
(2, '58be5a080c13d63503', 8, 8000, '2017-03-07 07:19:12', '2017-03-07 07:19:12'),
(3, '58be5a080c13d63503', 7, 1000, '2017-03-07 07:52:56', '2017-03-07 07:52:56'),
(4, '58be5a080c13d63503', 8, 8000, '2017-03-07 07:52:56', '2017-03-07 07:52:56');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `leee_order`
--

INSERT INTO `leee_order` (`id`, `u_id`, `order_id`, `bs_id`, `g_id`, `ss_id`, `relation_id`, `order_num`, `order_single_price`, `order_cash`, `machine_num`, `created_at`, `updated_at`, `status`) VALUES
(1, 6, '58be5a080c13d63503', 1, 1, 1, 1, 10, 1000, 10000, 'mac1', '2017-03-07 06:58:16', '2017-03-07 07:19:11', 1);

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
  `seller_precent` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '销售商铺分成',
  `buyer_precent` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购买商铺分成',
  `max_num` int(11) NOT NULL COMMENT '每天最大销售数',
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否上线销售',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `leee_sell_goods`
--

INSERT INTO `leee_sell_goods` (`id`, `s_id`, `p_id`, `name`, `desc`, `price`, `seller_precent`, `buyer_precent`, `max_num`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '炒鸡', '炒鸡肉', 2, 1, 1, -1, '', '', 1, '2017-03-07 06:51:03', '2017-03-08 01:33:46');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `leee_sell_shops`
--

INSERT INTO `leee_sell_shops` (`id`, `name`, `user_wechat`, `area`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '老杨炒面', 'ogXult5EMPUMoh-pNtu4VWb8c-9w', '11', '', '', '2017-03-07 06:50:05', '2017-03-07 06:50:22'),
(2, '魏家凉皮', '12313123sdasafsdf', '13', '', '', '2017-03-07 06:53:34', '2017-03-07 06:53:34');

-- --------------------------------------------------------

--
-- 表的结构 `leee_shops_relation`
--

CREATE TABLE IF NOT EXISTS `leee_shops_relation` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `qr_id` varchar(32) NOT NULL COMMENT 'qrcodeid',
  `bs_id` mediumint(8) unsigned NOT NULL COMMENT '购买商铺id',
  `ss_id` mediumint(8) unsigned NOT NULL COMMENT '销售商铺id',
  `status` tinyint(1) NOT NULL COMMENT '是否启用',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `leee_shops_relation`
--

INSERT INTO `leee_shops_relation` (`id`, `qr_id`, `bs_id`, `ss_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '58be595bdfc8f1', 1, 1, 1, '2017-03-07 06:55:23', '2017-03-07 06:55:23');

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
  `account_sum` int(15) unsigned NOT NULL DEFAULT '0' COMMENT '账户获得收益总计',
  `account_cash` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '账户目前余额',
  `account_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '账户单数统计',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `leee_user`
--

INSERT INTO `leee_user` (`id`, `openid`, `nick`, `avatar`, `status`, `reserve_num`, `reserve_price`, `account_sum`, `account_cash`, `account_num`, `created_at`, `updated_at`) VALUES
(1, '12313123sdasafsdf', 'charis', 'http://image.phpcomposer.com/d/1e/768684492400b1470aa7882b29d5c.png', 1, 0, 0, 0, 0, 0, '2017-03-02 03:48:10', '2017-03-02 05:15:18'),
(2, '12313123sdddd', 'charis', 'http://image.phpcomposer.com/d/1e/768684492400b1470aa7882b29d5c.png', 0, 0, 0, 0, 0, 0, '2017-03-05 01:50:59', '2017-03-02 03:48:37'),
(6, 'ogXult7wdxNhb2ZrTiDgAuOKb8V8', '芋头', 'http://wx.qlogo.cn/mmopen/UxWQlYy1khIibOgESpGHFZzFWPsmPef7uaTiaiapkI1fbkxM3FDxcOr9Nbu6eNMLPnPc3dqL5aib54Sy4act7TymQVLSWyCeGmXL/0', 1, 3, 20000, 5000, 5000, 1, '2017-03-05 01:38:12', '2017-03-08 07:26:26'),
(7, 'ogXult077N4Dp_Tbd3dWp0UPyEY4', '林中漫步', 'http://wx.qlogo.cn/mmopen/UDa9R1yl9UaSYkTpibhaBOIyzpibf3042Mkr7Sner1InjhN47qNNXyZIT1ru2smiclrDxMKktXeWpvKicChYic4eGTmjzgDoicd8SD/0', 1, 0, 0, 2000, 2000, 2, '2017-03-05 03:41:52', '2017-03-07 07:52:56'),
(8, 'ogXult5EMPUMoh-pNtu4VWb8c-9w', '流浪的小灰熊', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEIcyUhsI4PeoPST4HOUYsYibJ7KsyD4fIFRuleu5NsUHAaTkXQEQRhQicZJKJWhpeGJV2sjPoXQLU6aeicttscVGR8EGC6qAPLo6U/0', 1, 0, 0, 16000, 16000, 2, '2017-03-05 04:32:47', '2017-03-07 07:52:56');

-- --------------------------------------------------------

--
-- 表的结构 `leee_withdraw_flow`
--

CREATE TABLE IF NOT EXISTS `leee_withdraw_flow` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `price` int(10) unsigned NOT NULL COMMENT '提现金额',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '提现状态，0未审核，1，已提现，2，已驳回',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `leee_withdraw_flow`
--

INSERT INTO `leee_withdraw_flow` (`id`, `user_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 101, 0, '2017-03-07 07:51:35', '2017-03-08 07:26:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
