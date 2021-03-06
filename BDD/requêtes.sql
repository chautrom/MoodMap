--
-- database connection
--
connect moodmapDB

--
-- user
--
INSERT INTO user (username,email,password,activated,challenge)
 VALUES("elhafiani","elhafiani@ensicaen.fr","A59DFE0E288E1208A0FFF3C", false, "AB123EF");

--
-- criteria
--
INSERT INTO criteria (name,iconpath)
VALUES("happy","/icons/happy.png");



INSERT INTO criteria (name,iconpath)
 VALUES("sad","/icons/sad.png");

--
-- zone
--
INSERT INTO zone (name,x, y, r)
VALUES("zone1", 20, 20, 30);


INSERT INTO zone (name,x, y, r )
VALUES("zone2", 40, 40,30);

--
-- dataZone
--
INSERT INTO datazone (score,id_zone,id_criteria)
 VALUES(33.64, 1, 2); 

INSERT INTO datazone (score,id_zone,id_criteria)
 VALUES(62.4, 2, 1);

--
-- vote
--
INSERT INTO vote (id_user,id_criteria,id_datazone, score)
VALUES(1, 1, 1,5);

INSERT INTO vote (id_user,id_criteria,id_datazone, score)
VALUES(1, 2, 2,6);

--
-- SELECT REQUESTS
--
SELECT * from user;
SELECT * from criteria;
select * from vote;
select * from datazone;
select * from zone;

