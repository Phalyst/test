CREATE TABLE `companies` (
  `company_id` int(11),
  `company_name` varchar(100)
);

CREATE TABLE `users` (
  `user_id` int(11),
  `company_id` int(11),
  `user_name` varchar(100),
  `user_mtype` int(11)
);

INSERT INTO companies (company_id, company_name) VALUES (1, 'Random Company');
INSERT INTO companies (company_id, company_name) VALUES (2, 'Azeroth');
INSERT INTO companies (company_id, company_name) VALUES (3, 'Hermit Travels');
INSERT INTO companies (company_id, company_name) VALUES (4, 'Batman Inc.');

INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (1, 1, 'John Wick', 3);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (2, 1, 'Tony Stark', 2);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (3, 1, 'Oliver Queen', 2);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (4, 1, 'Ray Palmer', 1);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (5, 2, 'Varian Wrynn', 3);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (6, 2, 'Garrosh Hellscream', 3);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (7, 3, 'Deckard Cain', 1);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (8, 4, 'Bruce Wayne', 2);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (9, 4, 'Alfred Pennyworth', 3);
INSERT INTO users (user_id, company_id, user_name, user_mtype) VALUES (10, 0, 'Unlinked User', 1);