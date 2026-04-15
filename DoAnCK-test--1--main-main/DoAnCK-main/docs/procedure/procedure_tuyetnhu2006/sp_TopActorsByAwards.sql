DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TopActorsByAwards`()
BEGIN
    SELECT 
        a.Actor_ID,
        a.Actor_Name,
        COUNT(aa.Award_ID) AS Total_Awards
    FROM tbl_actor a
    LEFT JOIN `tbl_award-actor` aa 
        ON a.Actor_ID = aa.Actor_ID
    GROUP BY a.Actor_ID, a.Actor_Name
    ORDER BY Total_Awards DESC;
END$$
DELIMITER ;
