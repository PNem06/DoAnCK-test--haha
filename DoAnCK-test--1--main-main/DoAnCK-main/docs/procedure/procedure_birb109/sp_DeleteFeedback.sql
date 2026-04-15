DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteFeedback`(IN `p_Feedback_ID` INT(16))
BEGIN
	DELETE FROM tbl_feedback WHERE Feedback_ID=p_Feedback_ID;
END$$
DELIMITER ;
