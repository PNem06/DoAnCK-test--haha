DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TopMoviesByViews`(IN `p_Limit` INT)
BEGIN
    SELECT m.Movie_ID,
           m.Movie_Title,
           COUNT(mw.Movie_ID) AS TotalViews
    FROM tbl_movie m
    INNER JOIN `tbl_movie-watchlist` mw
        ON m.Movie_ID = mw.Movie_ID
    INNER JOIN tbl_watchlist wl
        ON mw.Watchlist_ID = wl.Watchlist_ID
    GROUP BY m.Movie_ID, m.Movie_Title
    ORDER BY TotalViews DESC
    LIMIT p_Limit;
END$$
DELIMITER ;
