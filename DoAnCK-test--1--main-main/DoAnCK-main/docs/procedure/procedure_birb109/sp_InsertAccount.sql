DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertAccount`(IN `Account_ID` INT(10) ZEROFILL, IN `Username` VARCHAR(32) CHARSET utf8mb4, IN `Password` VARCHAR(16) CHARSET utf8mb4, IN `Role_ID` ENUM('member','author','member-author') CHARSET utf8mb4, IN `Mail` VARCHAR(64) CHARSET utf8mb4, IN `Tel` INT(10) ZEROFILL, IN `Account_Img` VARCHAR(225))
BEGIN
	INSERT INTO tbl_account(Account_ID, Username, Password, Role_ID, Mail, Tel, Account_Img)
    VALUES (Account_ID, Username, Password, Role_ID, Mail, Tel, Account_Img);
END$$
DELIMITER ;
