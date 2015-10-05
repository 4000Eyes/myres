drop table if exists `res_company`;
create table `res_company`
(
`company_id` int(32) not null auto_increment,
`company_name` varchar(128) not null,
`company_address` varchar(256),
`company_type` int(2),
PRIMARY KEY(`company_id`)
) auto_increment=200;

drop table if exists `res_title`;
create table `res_title`
(
`title_id` int(32) not null auto_increment,
`title_name` varchar(128) not null,
`alternate_titles` varchar(256),
`title_level` int(2) ,
PRIMARY KEY(`title_id`)
) auto_increment=100;

drop table if exists `res_leadership_trait`;
create table `res_leadership_trait`
(
`leadership_trait_id` int(32) not null auto_increment,
`leadership_trait` varchar(128) not null,
PRIMARY KEY(`leadership_trait_id`)
) auto_increment=100;

drop table if exists `res_smart_goal_tmpl`;
create table `res_smart_goal_tmpl`
(
`smart_goal_tmpl_id` int(32) not null auto_increment,
`smart_goal_tmpl` varchar(512) not null,
`smart_goal_tmpl_type` int(2) not null,
PRIMARY KEY(`smart_goal_tmpl_id`)
) auto_increment=300
;

drop table  if exists `res_title_leadership_trait`;
create table `res_title_leadership_trait`
(
`title_id` int(32) not null ,
`leadership_trait_id` int(32) not null ,
`value_factor` int(2),
`sequence_id` int(2)
);

drop table if exists `res_smart_goal_matrix`;
create table `res_smart_goal_matrix`
(
`title_id` int(32) not null ,
`leadership_trait_id` int(32) not null ,
`smart_goal_tmpl_id` int(32) not null ,
`value_factor` int(2),
`sequence_id` int(2)
);

drop table if exists `res_user`;
create table `res_user`
(
`user_id` char(32) not null ,
`user_name` varchar(124) not null ,
`email_address` varchar(124) not null ,
`password` varchar(34),
`user_type` int(2),
`user_status` int(2),
 PRIMARY KEY (`user_id`)
);

drop table if exists `res_user_relation`;
create table `res_user_relation`
(
`smart_goal_id` int(32) not null ,
`relation_name` varchar(124) not null ,
`email_address` varchar(124) not null ,
`relation_type` int(2),
`sent_dt` datetime,
`send_status` int(2)
);


drop table if exists`res_user_smart_goal`;
create table `res_user_smart_goal`
(
`smart_goal_id` int(32) not null,
`user_id` char(32) not null ,
`leadership_trait_id` int(32) not null ,
`smart_goal_tmpl_id` int(32) not null ,
`company_id` int(32) not null,
`title_id` int(32) not null ,
`from_yymm` datetime not null,
`to_yymm` datetime not null,
`smart_goal_desc` varchar(512) not null,
`sequence_id` int(3) not null,
`res_eligible_id` int(3) not null
);

drop table if exists `res_user_smart_goal_reco`;
create table `res_user_smart_goal_reco`
(
`smart_goal_id` int(32) not null,
`user_id` char(32) not null ,
`leadership_trait_id` int(32) not null ,
`smart_goal_tmpl_id` int(32) not null ,
`company_id` int(32) not null,
`title_id` int(32) not null ,
`from_yymm` datetime not null,
`to_yymm` datetime not null,
`smart_goal_desc_sugg` varchar(512) not null,
`recorded_dt` datetime
);

CREATE TABLE `sessions` (
  `id` CHAR(128) NOT NULL,
  `set_time` CHAR(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` CHAR(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
