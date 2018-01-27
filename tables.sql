use site_myworld;

CREATE TABLE user(
   uName varchar(50)  NOT NULL,
   uPassword varchar(10) DEFAULT NULL,
   uRegisterDate datetime DEFAULT NULL,
   uLastLoginDate datetime DEFAULT NULL,
   uHeadImagePath varchar(50) DEFAULT NULL,
   uLastLoginIp varchar(20) DEFAULT '0.0.0.0',
   PRIMARY KEY (uName)
   PRIMARY KEY (uName)
 )；
 
 CREATE TABLE blog (
	bID int(5) auto_increment,
   bAuthor varchar(50) NOT NULL,
   bTitle varchar(20) NOT NULL,
   bContent varchar(50) DEFAULT NULL,
   bCatelog varchar(50) DEFAULT NULL,
   bTags varchar(100) DEFAULT NULL,
   bCreateDate datetime DEFAULT NULL,
   bModifyDate datetime DEFAULT NULL,
   PRIMARY KEY (bID),
   unique (bAuthor,bTitle),
   FOREIGN KEY (bAuthor) REFERENCES user (uName)
)auto_increment=00000;

CREATE TABLE comment(					-- 关于博客的评论
	cID int(5) auto_increment,			-- 评论的ID，主键
	cCommenter varchar(50) NOT NULL,	-- 评论者的昵称
    cBlogID int(5),						-- 被评论的博客ID
	cContent char(150),					-- 评论的文本内容，长度150以内
    cCommentDate datetime default null, -- 评论时间
    uCommentIp varchar(20) DEFAULT '0.0.0.0', -- 评论者的IP
    PRIMARY KEY(cID),
    foreign key (cCommenter) references user(uName),
    foreign key (cBlogID) references blog(bID)
)auto_increment=00000;

CREATE TABLE reply(						-- 关于评论的回复
	rID int(5) auto_increment,			-- 回复的ID，主键
	rReplier varchar(50) NOT NULL,		-- 评论者的昵称
    rReplyID int(5),					-- 被回复的评论ID
	rContent char(150),					-- 回复的文本内容，长度150以内
    rReplyDate datetime default null,	-- 回复时间
    rReplyIp varchar(20) DEFAULT '0.0.0.0', -- 回复时的IP
    PRIMARY KEY(rID),
    foreign key (rReplier) references user(uName),
    foreign key (rReplyID) references comment(cID)
)auto_increment=00000;

CREATE TABLE praise(					-- 博客收到的赞
	pID int(5) auto_increment,			-- 
    pPraiser varchar(50) NOT NULL,		-- 点赞者的昵称
    pBlogID int(5),						-- 被赞的博客ID
    pPraiseDate datetime default null,	-- 点赞时间
    pPraiseIp varchar(20) DEFAULT '0.0.0.0', -- 点赞时的IP
    primary key (pID),
	unique(pPraiser, pBlogID)
    foreign key (pPraiser) references user(uName),
    foreign key (pBlogID) references blog(bID)
)auto_increment=00000;

CREATE TABLE browse(					-- 浏览历史
	brBlogID int(5),					-- 被浏览的博客ID
    brBrowser varchar(50),				-- 浏览者昵称，可以为NULL
    brBrowseDate datetime default null,	-- 浏览时间
    foreign key (brBrowser) references user(uName),
    foreign key (brBlogID) references blog(bID)
)