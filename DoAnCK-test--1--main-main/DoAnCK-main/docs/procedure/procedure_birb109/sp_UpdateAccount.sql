DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UpdateAccount`(IN `p_Account_ID` INT(10) ZEROFILL, IN `p_Username` VARCHAR(32) CHARSET utf8mb4, IN `p_Password` VARCHAR(16) CHARSET utf8mb4, IN `p_Role_ID` ENUM('member','author','member-author') CHARSET utf8mb4, IN `p_Mail` VARCHAR(64) CHARSET utf8mb4, IN `p_Tel` INT(10) ZEROFILL, IN `p_Account_Img` VARCHAR(225) CHARSET utf8mb4)
BEGIN
	UPDATE tbl_account 
    SET
    	Username=p_Username,
        Password=p_Password,
        Role_ID=p_Role_ID,
        Mail=p_Mail,
        Tel=p_Tel,
        Account_Img=p_Account_Img
        WHERE Account_ID=p_Account_ID;
END$$
DELIMITER ;
