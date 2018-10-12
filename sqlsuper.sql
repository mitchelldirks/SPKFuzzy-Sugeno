select * from (select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `cmt`,`a`.`serv` AS `ck`,
	`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,
	`b`.`serv` AS `serv`,`b`.`fz` AS `fz` 
	from (`query-himpunan` `a` join `query-rules` `b`) 
	where ( a.netid=5 and 
	((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik',0) using latin1)))) 
	order by `a`.`netid`,`b`.`ruleid`) x, (SELECT
	`a`.`netid` AS `netid`,
	`a`.`b` AS `b`,
	`a`.`cmt` AS `cmt`,
	`a`.`ck` AS `ck`,
	min(`a`.`ruleid`)AS `rmin`,
	max(`a`.`ruleid`)AS `rmax`
FROM
	(select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `cmt`,`a`.`serv` AS `ck`,
	`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,
	`b`.`serv` AS `serv`,`b`.`fz` AS `fz` 
	from (`query-himpunan` `a` join `query-rules` `b`) 
	where ( a.netid=5 and 
	((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang',0) using latin1)) or 
			(`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak',0) using latin1))) and 
	((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup',0) using latin1)) or 
			(`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik',0) using latin1)))) 
	order by `a`.`netid`,`b`.`ruleid`) `a`) z where (x.ruleid=z.rmin or x.ruleid=z.rmax)