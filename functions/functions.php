<?php     
    /**
	 * Sanitizes data, trim, stripslashes and html special characters
	 */
	function sanitize($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

	/**
	 * Looping through all data from a table query
	 */
    function while_loop($loop){
    	$result = array();
    	while ($row = mysqli_fetch_array($loop)){
    		$result[] = $row;
    	}

    	return $result;
    }

	/**
	 * Returning all found data From while_loop query
	 */
    function find_by_sql($query){
		include 'conn.php';
		$result = mysqli_query($conn,$query);
		$result_set = while_loop($result);

		return $result_set;
	}

    /**
	 * password salt hashing
	 */
    function passSaltHash($pass){
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    //========================================================================
    // FIND FUNCTIONS

    /**
     * Checks if account exists in the database
     * Found in : login_validation
     */
    function find_login($username){
        $query = "SELECT * FROM user_info WHERE uname = '$username'";

        return find_by_sql($query);
    }

    /**
     * Finds all of the employees registered in the system
     * Found in : profile
     */
    function find_employee_list(){
        $query = "SELECT * FROM user_info";

        return find_by_sql($query);
    }

    /**
     * Checks details of the user logged in in the database
     * Found in : profile, profile-admin
     */
    function find_employee_list_login($email){
        $query = "SELECT * FROM user_info WHERE eaddr = '$email'";

        return find_by_sql($query);
    }

    /**
     * Finds all of the log entries in the database
     * Found in : audit_log
     */
    function find_logs(){
        $query = "SELECT al.u_id, al.remote_ip, al.action, al.location, al.date, ui.u_id, ui.uname, ui.name 
                    FROM audit_log al 
                    LEFT JOIN user_info ui
                    ON ui.u_id = al.u_id
                    ORDER BY al.u_id DESC";

        return find_by_sql($query);
    }

    /**
     * Finds all of the Department in the database
     * Found in : department
     */
    function find_department(){
        $query = "SELECT * FROM dep_info";

        return find_by_sql($query);
    }

    /**
     * Finds all of Department in the dropdown in the database
     * Found in : addCandidateModal
     */
    function find_department_search(){
        $query = "SELECT * FROM dep_info ORDER BY d_name";

        return find_by_sql($query);
    }

    function find_department_position(){
        $query = "SELECT p.d_id, d.d_id, d.d_name, d.d_team 
                    FROM dep_info d 
                    LEFT JOIN pos_info p
                    ON d.d_id = p.d_id
                    GROUP BY p.d_id";

        return find_by_sql($query);      
    }

    /**
     * Finds all of Position in the database
     * Found in : position
     */
    function find_position(){
        $query = "SELECT p.p_id, p.p_cid, p.d_id, p.p_name, p.p_date, p.p_req, p.p_count, p.p_hired, p.p_closed, d.d_id, d.d_cid, d.d_name, d.d_team
                    FROM pos_info p
                    LEFT JOIN dep_info d
                    ON p.d_id = d.d_id";

        return find_by_sql($query);
    }

    /**
     * Finds all of Position in the database
     * Found in : index
     */
    function find_position_cand(){
        $query = "SELECT d.d_id, p.*, DATE(p.p_date) as date, (SELECT COUNT(c.p_id) FROM cand_info c WHERE p.p_id = c.p_id) as id
                    FROM pos_info p
                    LEFT JOIN cand_info c
                    ON p.d_id = c.c_id
                    LEFT JOIN dep_info d
                    ON d.d_id = p.d_id";

        return find_by_sql($query);
    }


    /**
     * Finds all of the Open requisition in the database
     * Found in : report
     */
    function find_requistion_phase($p_id, $start_date, $end_date){
        $query = "SELECT c.c_id, c.p_id, MAX(i.phase), GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) AS greatest,
                    CASE
                        WHEN c.c_padate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_padate
                    END AS passed,
                    CASE
                        WHEN c.c_fdate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_fdate
                    END AS fail,
                    CASE
                        WHEN c.c_podate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_podate
                    END AS pooling,
                    CASE
                        WHEN c.c_wdate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_wdate
                    END AS withdrawn,
                    CASE
                        WHEN c.c_udate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_udate
                    END AS unresponsive
                    FROM cand_info c
                    LEFT JOIN int_scores i
                    ON c.c_id = i.c_id
                    WHERE c.p_id = '$p_id' AND ((c.c_padate BETWEEN '$start_date' AND '$end_date') OR (c.c_podate BETWEEN '$start_date' AND '$end_date') OR (c.c_fdate BETWEEN '$start_date' AND '$end_date') OR (c.c_wdate BETWEEN '$start_date' AND '$end_date') OR (c.c_udate BETWEEN '$start_date' AND '$end_date'))
                    GROUP BY c.c_id";

        return find_by_sql($query);
    }

    /**
     * Finds all of the Open requisition in the database
     * Found in : report
     */
    function find_requistion_count($p_id, $start_date, $end_date, $phase){
        // $query = "SELECT COUNT(a.passed), COUNT(a.fail), COUNT(a.pooling), COUNT(a.withdrawn), COUNT(a.unresponsive) FROM (    
        //         SELECT c.c_id, c.p_id, MAX(i.phase), GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) AS greatest,
        //             CASE
        //                 WHEN c.c_padate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_padate
        //             END AS passed,
        //             CASE
        //                 WHEN c.c_fdate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_fdate
        //             END AS fail,
        //             CASE
        //                 WHEN c.c_podate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_podate
        //             END AS pooling,
        //             CASE
        //                 WHEN c.c_wdate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_wdate
        //             END AS withdrawn,
        //             CASE
        //                 WHEN c.c_udate = GREATEST(c.c_padate, c.c_podate, c.c_fdate, c.c_wdate, c.c_udate) THEN c.c_udate
        //             END AS unresponsive
        //             FROM cand_info c
        //             LEFT JOIN int_scores i
        //             ON c.c_id = i.c_id
        //             WHERE ((i.phase = '6') AND (c.c_padate BETWEEN '2022-10-10' AND '2022-10-16')) OR ((i.phase = '6') AND (c.c_podate BETWEEN '2022-10-10' AND '2022-10-16')) OR ((i.phase = '6') AND (c.c_fdate BETWEEN '2022-10-10' AND '2022-10-16')) OR ((i.phase = '6') AND (c.c_wdate BETWEEN '2022-10-10' AND '2022-10-16')) OR ((i.phase = '6') AND (c.c_udate BETWEEN '2022-10-10' AND '2022-10-16'))
        //             GROUP BY c.c_id
        // ) AS a WHERE p_id = '$p_id'";
            //etong part dibali parang sinelect ko yung result nung unang query tama ba pagkakagets ko sa question mo?oo tama dibali yung unang query is yung nasa loob tas second yung nasa labas. ah kung sino yung nasa inner sya yung mauuna tama ba?
        // return find_by_sql($query);
    }

    /**
     * Finds all of Position in the dropdown in the database
     * Found in : addCandidateModal
     */
    function find_position_search(){
        $query = "SELECT * FROM pos_info ORDER BY p_name";

        return find_by_sql($query);
    }

    /**
     * Finds all of Interviwer in the database
     * Found in : interviewer
     */
    function find_interviewer(){
        $query = "SELECT * FROM `int_info` WHERE retired != '1'";

        return find_by_sql($query);
    }

    /**
     * Finds all of Interviewer in the dropdown in the database
     * Found in : addCandidateModal
     */
    function find_interviewer_search(){
        $query = "SELECT * FROM `int_info` WHERE retired != '1' ORDER BY i_name";

        return find_by_sql($query);
    }

    /**
     * Finds all of Interviewer in the dropdown in the database
     * Found in : viewCandidates
     */
    function find_interviewerView_search(){
        $query = "SELECT * FROM `int_info` WHERE retired != '1' ORDER BY i_name";

        return find_by_sql($query);
    }

    /**
     * Finds all of Source in the database
     * Found in : source
     */
    function find_source(){
        $query = "SELECT * FROM `src_info` WHERE retired != '1'";

        return find_by_sql($query);
    }

    /**
     * Finds all of Source in the dropdown in the database
     * Found in : addCandidateModal
     */
    
    function find_source_search(){
        $query = "SELECT * FROM `src_info` WHERE retired != '1' ORDER BY s_name";

        return find_by_sql($query);
    }
    /**
     * Finds all of the Candidate in the database
     * Found in : listOfCandidates
     */
    function find_candidates(){
        $query = "SELECT c.c_cid, c.c_id, c.c_name, c.c_actpas, c.d_id, c.p_id, c.retired, d.d_id, d.d_name, p.p_id, p.p_name, c.reprofile
                     FROM cand_info c
                     LEFT JOIN dep_info d
                     ON c.d_id = d.d_id
                     LEFT JOIN pos_info p
                     ON c.p_id = p.p_id
                     WHERE c.retired != '1'";

        return find_by_sql($query);
    }

    function find_candidates_year(){
        $query = "SELECT YEAR(c_appli) FROM cand_info";

        return find_by_sql($query);
    }

    /**
     * Finds the phase of a candidate in the database
     * Found in : listOfCandidates
     */
    function find_phase($c_id){
        $query = "SELECT c.c_id, i.c_id, i.phase
                    FROM cand_info c
                    LEFT JOIN int_scores i
                    ON c.c_id = i.c_id
                    WHERE c.c_id = '$c_id'
                    ORDER BY i.score_id DESC
                    LIMIT 1";

        return find_by_sql($query);
    }

    /**
     * Finds the phase, name, and id of a candidate in the database
     * Found in : iff, report
     */
    function find_phase_all(){
        $query = "SELECT i.c_id, i.phase, c.c_cid, c.c_name, i.score_id, i.status
                    FROM int_scores i
                    LEFT JOIN cand_info c 
                    ON i.c_id = c.c_id
                    ORDER BY i.score_id DESC";

        return find_by_sql($query);
    }

    /**
     * Finds the phase of a specific position in the database
     * Found in : report
     */
    function find_phase_position($p_id, $start_date, $end_date){
        $query = "SELECT c.c_id, i.phase, c.p_id
        FROM cand_info c
        LEFT JOIN int_scores i
        ON c.c_id = i.c_id
        WHERE c.p_id = '$p_id' AND ((c.c_padate BETWEEN '$start_date' AND '$end_date') OR (c.c_podate BETWEEN '$start_date' AND '$end_date') OR (c.c_fdate BETWEEN '$start_date' AND '$end_date') OR (c.c_wdate BETWEEN '$start_date' AND '$end_date') OR (c.c_udate BETWEEN '$start_date' AND '$end_date'));";

        return find_by_sql($query);
    }

    /**
     * Finds the status of a candidate in the database
     * Found in : listOfCandidates
     */
    function find_status($c_id){
        // $query = "SELECT c.c_id, i.c_id, i.status
        //             FROM cand_info c
        //             LEFT JOIN int_scores i
        //             ON c.c_id = i.c_id
        //             WHERE c.c_id = '$c_id'
        //             ORDER BY score_id DESC";

        $query = "SELECT c_id, c_padate, c_job, c_jdate, c_podate, c_fdate, c_wdate, c_udate, GREATEST(c_padate, c_jdate, c_podate, c_fdate, c_wdate, c_udate) AS greatest FROM cand_info WHERE c_id = '$c_id'";

        return find_by_sql($query);
    }

    /**
     * Finds details of the Candidate in the database
     * Found in : viewCandidates
     */
    function find_candidates_view($c_id){
        $query = "SELECT c.c_cid, c.c_id, c.c_name, c.c_eaddr, c.c_actpas, c.c_appli, c.c_school, c.c_course, c.s_id, c.d_id, c.c_folder, c.p_id, d.d_id, d.d_name, p.p_id, p.p_name, s.s_id, s.s_name
                     FROM cand_info c
                     LEFT JOIN dep_info d
                     ON c.d_id = d.d_id
                     LEFT JOIN pos_info p
                     ON c.p_id = p.p_id
                     LEFT JOIN src_info s
                     ON c.s_id = s.s_id
                     WHERE c.c_id = '$c_id'";

        return find_by_sql($query);
    }

    /**
     * Finds details of the Cognitive and PI of the Candidate in the database
     * Found in : viewCandidates
     */
    function find_cogpre_view($c_id){
        $query = "SELECT cp.c_id, cp.cog_1, cp.cog_2, cp.raw_1, cp.raw_2, cp.verb_1, cp.verb_2, cp.num_1, cp.num_2, cp.abs_1, cp.abs_2, cp.dom_bird, cp.dove, cp.owl, cp.peacock, cp.eagle, cp.beh_pro, cp.beh_cat, cp.beh_a, cp.beh_b, cp.beh_c, cp.beh_d, cp.beh_ab, cp.beh_ac, cp.beh_ad, cp.beh_bc, cp.beh_bd, cp.beh_cd
                    FROM cog_pre cp
                    WHERE c_id = '$c_id'";

        return find_by_sql($query);
    }

    /**
     * Finds details of the Initial Interview of the Cadidate in the database
     * Found in : viewCandidates
     */
    function find_ini_int($c_id){
        $query = "SELECT ini.c_id, ini.i_id, ini.sme, ini.com, ini.pro, ini.cog, ini.sol, ini.int_int, ini.own, ini.lead, ini.ddl, ini.total, ini.poscom, ini.negcom, ini.allcom, ini.int_date, ini.status, ini.phase
                    FROM ini_int ini
                    WHERE c_id = '$c_id';";

        return find_by_sql($query);
    }

    /**
     * Finds details of the Initial Interview of the Cadidate in the database
     * Found in : viewCandidates
     */
    function find_int_name($cogpre_id){
        $query = "SELECT i_name
                    FROM int_info
                    WHERE i_id = '$cogpre_id';";

        return find_by_sql($query);
    }

    /**
     * Finds the email of the interviewer for scoring in the database
     * Found in : listOfCandidates
     */
    function find_email_interviewer($i_id){
        $query = "SELECT i_eaddr, i_name FROM int_info WHERE i_id = '$i_id'";

        return find_by_sql($query);
    }

    /**
     * Finds the IFF of the candidate in the database
     * Found in : iff
     */
    function find_iff_default(){
        $query = "SELECT cand.c_id, cand.c_name, cand.c_eaddr, cand.c_actpas, cand.c_actpas, cand.c_appli, cand.d_id, cand.p_id, cand.c_school, cand.c_course, cand.c_folder, pos.p_id, pos.p_name, dep.d_id, dep.d_name, dep.d_team, cp.cog_1, cp.cog_2, cp.raw_1, cp.raw_2, cp.verb_1, cp.verb_2, cp.num_1, cp.num_2, cp.abs_1, cp.abs_2, cp.dom_bird, cp.dove, cp.owl, cp.peacock, cp.eagle, cp.beh_pro, cp.beh_cat, cp.beh_a, cp.beh_b, cp.beh_c, cp.beh_d, cp.beh_ab, cp.beh_ac, cp.beh_ad, cp.beh_bc, cp.beh_bd, cp.beh_cd
                    FROM cand_info cand
                    LEFT JOIN pos_info pos
                    ON cand.p_id = pos.p_id
                    LEFT JOIN dep_info dep
                    ON cand.d_id = dep.d_id
                    LEFT JOIN cog_pre cp
                    ON cand.c_id = cp.c_id";

        return find_by_sql($query);
    }

    /**
     * 
     * 
     */
    function find_iff_intscore($id){

    }

    /**
     * Finds the IFF of the candidate in the database
     * EDIT: Added int_scores table and phase condition
     * Found in : iff
     */
    function find_iff($id,$interview_phase,$interviewer_name){
        $query = "SELECT cand.c_id, cand.s_id, cand.c_name, cand.c_eaddr, cand.c_actpas, cand.c_actpas, cand.c_appli, cand.d_id, cand.p_id, cand.c_school, cand.c_course, cand.c_folder, s.s_id, s.s_name ,pos.p_id, pos.p_name, dep.d_id, dep.d_name, dep.d_team, cp.cog_1, cp.cog_2, cp.raw_1, cp.raw_2, cp.verb_1, cp.verb_2, cp.num_1, cp.num_2, cp.abs_1, cp.abs_2, cp.dom_bird, cp.dove, cp.owl, cp.peacock, cp.eagle, cp.beh_pro, cp.beh_cat, cp.beh_a, cp.beh_b, cp.beh_c, cp.beh_d, cp.beh_ab, cp.beh_ac, cp.beh_ad, cp.beh_bc, cp.beh_bd, cp.beh_cd
                    ,score.sme, score.com, score.pro, score.cog, score.sol, score.int_int, score.own, score.lead, score.ddl, score.poscom, score.negcom, score.allcom, score.i_id
                    FROM cand_info cand
                    LEFT JOIN pos_info pos
                    ON cand.p_id = pos.p_id
                    LEFT JOIN dep_info dep
                    ON cand.d_id = dep.d_id
                    LEFT JOIN cog_pre cp
                    ON cand.c_id = cp.c_id
                    LEFT JOIN src_info s
                    ON cand.s_id = s.s_id
                    LEFT JOIN int_scores score
                    ON cand.c_id = score.c_id AND score.phase = $interview_phase AND score.i_id = $interviewer_name
                    WHERE cand.c_id = '$id'";

        return find_by_sql($query);
    }

    /**
     * Finds the interviewer of the IFF scoring candidate
     * Found in : iff
     */
    function find_iff_interviewer($i_id){
        $query = "SELECT * FROM int_info WHERE i_id = '$i_id'";

        return find_by_sql($query);
    }

    /**
     * Finds the phase and name in IFF in the database
     * Found in : iff_validation
     */
    function find_candidate_iff($name, $phase){
        $query = "SELECT * FROM int_scores WHERE c_id = '$name' AND phase = '$phase'";

        return find_by_sql($query);
    }

    /**
     * Finds the score of the candidate and its phase in the database
     * Found in : iff_data
     */
    // function find_score($interview_phase, $id){
    //     $query = "SELECT * FROM `". $interview_phase ."` WHERE c_id = '$id'";

    //     return find_by_sql($query);
    // }

    /**
     * Finds approval in the database
     * Found in : iffApproval
     */
    function find_approval(){
        $query = "SELECT iff.iff_int_id, iff.c_id, iff.i_id, iff.iff_sme, iff.iff_com, iff.iff_pro, iff.iff_cog, iff.iff_sol, iff.iff_int, iff.iff_own, iff.iff_lead, iff.iff_ddl, iff.iff_total, iff.iff_poscom, iff.iff_negcom, iff.iff_allcom, iff.iff_date, iff.iff_status, iff.iff_phase, c.c_id, c.c_name, i.i_id, i.i_name
                    FROM iff_int iff
                    LEFT JOIN cand_info c
                    ON iff.c_id = c.c_id
                    LEFT JOIN int_info i
                    ON iff.i_id = i.i_id";

        return find_by_sql($query);
    }

    /**
     * Finds the count of approval in the database
     * Found in : sidebar
     */
    function find_approval_count(){
        $query = "SELECT COUNT(iff_int_id) FROM iff_int WHERE approval = 0";

        return find_by_sql($query);
    }

    /**
     * Finds the value with the max id
     * Found in : index.php
     */
    function find_tth_value(){
        $query = "SELECT * FROM dash_info WHERE dash_id = (SELECT MAX(dash_id) FROM dash_info)";

        return find_by_sql($query);
    }

    /**
     * Finds the sum of values of p_hired and p_closed from pos_info
     * Found in : index.php
     */
    function find_pos_value($year){
        $query = "SELECT SUM(p_hired), SUM(p_closed) FROM pos_info WHERE YEAR(p_date) = '2022'";

        return find_by_sql($query);
    }

    function find_year(){
        $query = "SELECT YEAR(c_appli) as year from cand_info GROUP BY YEAR(c_appli) DESC";

        return find_by_sql($query);
    }

    function find_top5_chart($depid, $posid,$filterdate){
        if($depid != 0 && $posid != 0){
            // $query = "SELECT c.c_name as name1, s.c_id, s.total as count_status FROM cand_info c, int_scores s
            // WHERE c.p_id = $posid AND c.d_id = $depid AND s.c_id = c.c_id
            // GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            if($filterdate == 0){
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE c.p_id = $posid AND c.d_id = $depid AND cp.c_id = c.c_id
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
            else {
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE c.p_id = $posid AND c.d_id = $depid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
        }
        else if($depid != 0 && $posid ==0){
            if($filterdate == 0){
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE c.d_id = $depid AND cp.c_id = c.c_id
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
            else{
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE c.d_id = $depid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
        }
        else if($posid != 0 && $depid == 0){
            if($filterdate == 0){
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE c.p_id = $posid AND cp.c_id = c.c_id
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
            else{
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE c.p_id = $posid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
        }
        else {
            if($filterdate == 0){
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE cp.c_id = c.c_id
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
            else{
                $query = "SELECT c.c_name as name1, cp.c_id, cp.raw_1 as count_status FROM cand_info c, cog_pre cp
                WHERE cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status DESC LIMIT 5";
            }
        }

        return find_by_sql($query);

    }

    /**
     * Find Decisions
     * Found in: iff_data.php
     */

     function find_decision(){
        if(!empty(isset($_GET['id'])) && !empty(isset($_GET['interviewer_id'])) && !empty(isset($_GET['phase']))){
            $int_int = $_GET['interviewer_id'];
            $int_id = $_GET['id'];
            $int_phase = $_GET['phase'];
            $query = "SELECT status FROM int_scores WHERE c_id = $int_id AND phase = $int_phase AND i_id = $int_int";
            $result = find_by_sql($query);
            return $result[0][0];
        }
        else {
            return 'no data';
        }
     }

    // function find_old_interviewer($interview_phase,$id){
    //     $query = "SELECT score.phase, info.i_name, score.i_id FROM int_scores score, cand_info c, int_info info
    //     WHERE c.c_id = $id AND score.c_id = $id AND info.i_id = score.i_id";
        // $query = "SELECT score.phase, info.i_name, score.i_id FROM int_scores score
        // LEFT JOIN cand_info c
        // ON score.c_id = c.c_id
        // LEFT JOIN int_info info
        // ON info.i_id = score.i_id
        //         WHERE c.c_id = $id AND score.c_id = $id ORDER BY score.phase DESC";
        

    //     return find_by_sql($query);

    //  }

    /**
     * Find all phases the candidate finished
     * Found in: iff_data.php
     */

    function find_iff_phase($id){
        $query = "SELECT DISTINCT score.status, c.c_id, score.c_id, score.i_id, score.phase as phase FROM cand_info c, int_scores score
        WHERE score.c_id = $id AND c.c_id = $id";

        return find_by_sql($query);
    }
    
    /**
     * Find if candidate passed a phase already
     * found in: scorecandidatemodal.php
     */
    function phase_passed_checker(){
        // $query = "SELECT c.c_id, i.phase, i.status FROM cand_info c, int_scores i
        // WHERE i.c_id = $id AND i.status = 'Passed' AND i.phase = $phase AND c.c_id = i.c_id";
        $query = "SELECT s.c_id, s.phase, s.status FROM int_scores s";

        return find_by_sql($query);
    }

    /**
     * find if pos is same from user
     * found in: listofcandidates_validation.php
     */ 
    function if_samePos($userid,$posid){
        $query = "SELECT p_id FROM cand_info WHERE c_id = $userid";
        $result = find_by_sql($query);
        if($result[0]['p_id'] == $posid){
            return true;
        }else{
            return false;
        }

        // return $result[0];
    }

    /**
     * Dashboard find dept and pos filter
     */

    function find_dash_dept(){
        $query = "SELECT d_id, d_name FROM dep_info";

        return find_by_sql($query);
    }
    function find_dash_pos(){
        $query = "SELECT p_id, p_name FROM pos_info";

        return find_by_sql($query);
    }

    function find_trait(){

        if(!empty(isset($_GET['id']))){
            $id = $_GET['id'];
            include 'conn.php';
            $query = "SELECT sme,com,pro,cog,sol,int_int,own,lead,ddl FROM int_scores WHERE c_id = $id ORDER BY phase";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)){
                $arr[] = $row;
            }
            return $arr;
            // return find_by_sql($query);
        }
        
    }

    /**
     * Find actual and average dominant profile
     * foud in viewcandidates.php
    */
    function aa_dominantProf($id){
        $query = "SELECT dom_bird FROM cog_pre WHERE c_id = $id";
        return find_by_sql($query);
    }
    function avg_domBird($id){
        $query = "SELECT c_id, dom_bird as dom, COUNT(dom_bird) AS MOST_FREQUENT from cog_pre WHERE c_id != $id GROUP BY dom_bird ORDER BY COUNT(dom_bird) DESC";
        return find_by_sql($query);
    }

    /**
     * Find actual and average behavorial profile
     */
    function aa_behProf($id){
        $query = "SELECT beh_pro FROM cog_pre WHERE c_id = $id";
        return find_by_sql($query);
    }
    function avg_behProf($id){
        $query = "SELECT beh_pro, COUNT(beh_pro) as counting FROM cog_pre WHERE c_id != $id GROUP BY beh_pro ORDER BY counting DESC";
        return find_by_sql($query);
    }

    /**
     * Find actual and average behavorial category
     * found in: viewcandidates.php
     */
    function aa_behCat($id){
        $query = "SELECT beh_cat FROM cog_pre WHERE c_id = $id";
        return find_by_sql($query);
    }
    function avg_behCat($id){
        $query = "SELECT beh_cat, COUNT(beh_cat) as counting FROM cog_pre WHERE c_id != $id GROUP BY beh_cat ORDER BY counting DESC";
        return find_by_sql($query);
    }

    /**
     * Find actual and average cognitive assesment
     * found in: viewcandidate.php
     */
    function cog_asses(){
        include 'conn.php';
        // $rows = array();
        $query = "SELECT AVG(qwe.cog_avg) as cog_avg, AVG(qwe.raw_avg) as raw_avg, AVG(qwe.verb_avg) as verb_avg, AVG(qwe.num_avg) as num_avg, AVG(qwe.abs_avg) as abs_avg  

        FROM (SELECT cog_1/cog_2 as cog_avg, raw_1/raw_2 as raw_avg, verb_1/verb_2 as verb_avg, num_1/num_2 as num_avg, abs_1/abs_2 as abs_avg FROM cog_pre WHERE c_id != 28) AS qwe;";
        // $result = mysqli_query($conn, $query);
        // while($row=mysqli_fetch_assoc($result)){
        //     $rows[] = $row;
           
        // }
        return find_by_sql($query);
    }

    function actual_asses(){
        // include 'conn.php';
        $query = "SELECT c_id, cog_1, cog_2, raw_1, raw_2, verb_1, verb_2, num_1, num_2, abs_1, abs_2 FROM cog_pre";

        return find_by_sql($query);
    }

    
    


    /**
     * Find all interviewer base on interview phase
     * Found in: iff_data.php
     */

    // function find_interviewer_dd(){
    //     $query = "SELECT info.i_name, c.c_id, score.c_id, score.phase FROM cand_info c, int_scores score, int_info info
    //     WHERE score.c_id = 83 AND c.c_id = 83 AND score.phase = 3 AND info.i_id = score.i_id";

    //     return find_by_sql($query);
    // }


    //========================================================================
    // UPDATE FUNCTIONS

    /**
     * Update last login of the user
     * Found in : login_validation
     */
    function update_login($username, $date){
        $query = "UPDATE user_info SET date = '$date' WHERE uname = '$username'";

        return $query;
    }

    /**
     * Update username of the account logged in
     * Found in : profile_validation
     */
    function update_credentials($username, $email){
		$query = "UPDATE user_info SET uname = '$username' WHERE eaddr = '$email'";

		return $query;
	}

    /**
     * Update password of the account logged in
     * Found in : profile_validation
     */
    function update_password($email, $new_pass){
		$query = "UPDATE user_info SET passw = '$new_pass' WHERE eaddr = '$email'";

		return $query;
	}

    /**
     * Update department in the database
     * Found in : department_validation
     */
    function update_department($d_id, $d_name, $d_team){
        $query = "UPDATE dep_info SET d_name = '$d_name', d_team = '$d_team' WHERE d_cid = '$d_id'";

        return $query;
    }

    /**
     * Update interviewer in the database
     * Found in : interviewer_validation
     */
    function update_interviewer($i_id, $i_name, $i_email){
        $query = "UPDATE int_info SET i_name = '$i_name', i_eaddr = '$i_email' WHERE i_cid = '$i_id'";

        return $query;
    }

    /**
     * Update source in the database
     * Found in : source_validation
     */
    function update_source($s_cid, $s_name){
        $query = "UPDATE src_info SET s_name = '$s_name' WHERE s_cid = '$s_cid'";

        return $query;
    }

    /**
     * Update position in the database
     * Found in : position_validation
     */
    function update_position($p_id, $p_department, $p_name, $p_req, $p_count){
        $query = "UPDATE pos_info SET d_id = '$p_department', p_name = '$p_name', p_count = '$p_count', p_req = '$p_req' WHERE p_cid = '$p_id'";

        return $query;
    }

    /**
     * Update candidate profile in the database
     * Found in : listOfCandidates_validation.php
     */
    function update_candidate($c_id, $c_name, $c_eaddr, $s_id, $c_actpas, $c_appli, $c_school, $c_course, $d_id, $p_id, $c_folder){
        $query = "UPDATE cand_info SET c_name = '$c_name', c_eaddr = '$c_eaddr', s_id = '$s_id', c_actpas = '$c_actpas', c_appli = '$c_appli', c_school = '$c_school', c_course = '$c_course', d_id = '$d_id', p_id = '$p_id', c_folder = '$c_folder' WHERE c_id = '$c_id'";        

        return $query;
    }

    /**
     * Update predictive index in the database
     * Found in : listOfCandidates_validation.php
     */
    function update_cognitive($c_id, $cog_1, $cog_2, $raw_1, $raw_2, $verb_1, $verb_2, $num_1, $num_2, $abs_1, $abs_2, $beh_pro, $beh_cat, $beh_a, $beh_b, $beh_c, $beh_d, $beh_ab, $beh_ac, $beh_ad, $beh_bc, $beh_bd, $beh_cd){
        $query = "UPDATE cog_pre SET cog_1 = '$cog_1', cog_2 = '$cog_2', raw_1 = '$raw_1', raw_2 = '$raw_2', verb_1 = '$verb_1', verb_2 = '$verb_2', num_1 = '$num_1', num_2 = '$num_2', abs_1 = '$abs_1', abs_2 = '$abs_2', beh_pro = '$beh_pro', beh_cat = '$beh_cat', beh_a = '$beh_a', beh_b = '$beh_b', beh_c = '$beh_c', beh_d = '$beh_d', beh_ab = '$beh_ab', beh_ac = '$beh_ac', beh_ad = '$beh_ad', beh_bc = '$beh_bc', beh_bd = '$beh_bd', beh_cd = '$beh_cd' WHERE c_id = '$c_id'";        

        return $query;
    }

    /**
     * Update department d_cid with proper formatting
     * Found in : depa_validation.php
     */
    function update_depid($d_cid, $id){
        $query = "UPDATE dep_info SET `d_cid` = '$d_cid' WHERE `d_id` = '$id'";

        return $query;
    }

    /**
     * Update department d_cid with proper formatting
     * Found in : depa_validation.php
     */
    function update_intid($i_cid, $id){
        $query = "UPDATE int_info SET `i_cid` = '$i_cid' WHERE `i_id` = '$id'";

        return $query;
    }

    /**
     * Update department d_cid with proper formatting
     * Found in : depa_validation.php
     */
    function update_posid($p_cid, $id){
        $query = "UPDATE pos_info SET `p_cid` = '$p_cid' WHERE `p_id` = '$id'";

        return $query;
    }

    /**
     * Update department d_cid with proper formatting
     * Found in : depa_validation.php
     */
    function update_srcid($s_cid, $id){
        $query = "UPDATE src_info SET `s_cid` = '$s_cid' WHERE `s_id` = '$id'";

        return $query;
    }

    /**
     * Update department d_cid with proper formatting
     * Found in : depa_validation.php
     */
    function update_candid($c_cid, $id){
        $query = "UPDATE cand_info SET `c_cid` = '$c_cid' WHERE `c_id` = '$id'";

        return $query;
    }

    /**
     * update cand info reprofile value if pos is changed
     * found in: listofcandidates_validation.php
     */

    function update_reprofile($cid){
        $query = "UPDATE cand_info SET reprofile = 0 WHERE c_id = '$cid'";

        return $query;
    }


    //========================================================================
    // INSERT FUNCTIONS

    /**
     * Insert user into the database
     * Found in : profile_validation
     */
    function insert_employee($username, $name, $email, $privilege, $password, $date){
        $query = "INSERT INTO user_info (`u_id`, `uname`, `eaddr`, `passw`, `name`, `level`, `date`) VALUES
                    ( default, '$username', '$email', '$password', '$name', '$privilege', '$date' )";

        return $query;
    }

    /**
     * Insert candidate into the database
     * Found in : addCandidate_db
     */
    function insert_candidate($c_name, $c_eaddr, $s_id, $c_actpas, $c_appli, $c_school, $c_course, $d_id, $p_id, $c_folder, $temp_date){
        $query = "INSERT INTO cand_info (c_id, c_name, c_eaddr, s_id, c_actpas, c_appli, c_school, c_course, d_id, p_id, c_folder, c_padate, c_job, c_jdate, c_podate,  c_fdate, c_wdate, retired) VALUES 
                    ( default, '$c_name','$c_eaddr','$s_id','$c_actpas','$c_appli','$c_school','$c_course','$d_id','$p_id','$c_folder','$temp_date','','$temp_date','$temp_date','$temp_date','$temp_date',0)";

        return $query;
    }

    /**
     * Insert cognitive assessment and predictive index into the database
     * Found in : addCandidate_db
     */
    function insert_cognitive($id, $cog_1, $cog_2, $raw_1, $raw_2, $verb_1, $verb_2, $num_1, $num_2, $abs_1, $abs_2, $beh_pro, $beh_cat, $beh_a, $beh_b, $beh_c, $beh_d, $beh_ab, $beh_ac, $beh_ad, $beh_bc, $beh_bd, $beh_cd, $dom_bird, $dove, $owl, $peacock, $eagle){
        $query = "INSERT INTO `cog_pre` (`c_id`, `cog_1`, `cog_2`, `raw_1`, `raw_2`, `verb_1`, `verb_2`, `num_1`, `num_2`, `abs_1`, `abs_2`, `dom_bird`, `dove`, `owl`, `peacock`, `eagle`, `beh_pro`, `beh_cat`, `beh_a`, `beh_b`, `beh_c`, `beh_d`, `beh_ab`, `beh_ac`, `beh_ad`, `beh_bc`, `beh_bd`, `beh_cd`) 
                    VALUES ('$id', '$cog_1', '$cog_2', '$raw_1', '$raw_2', '$verb_1', '$verb_2', '$num_1', '$num_2', '$abs_1', '$abs_2', '$dom_bird', '$dove', '$owl', '$peacock', '$eagle', '$beh_pro', '$beh_cat', '$beh_a', '$beh_b', '$beh_c', '$beh_d', '$beh_ab', '$beh_ac', '$beh_ad', '$beh_bc', '$beh_bd', '$beh_cd')";

        return $query;
    }

    /**
     * Insert  into the database
     * Found in : addCandidate_db
     */
    function insert_score($id){

    }

    /**
     * Insert department into the database
     * Found in : department_validation
     */
    function insert_department($d_name, $d_team){
        $query = "INSERT INTO dep_info (`d_id`, `d_name`, `d_team`) VALUES
                    ( default, '$d_name', '$d_team')";
        
        return $query;
    }

    /**
     * Insert position into the database
     * Found in : position_validation
     */
    function insert_position($p_department, $p_name, $p_date, $p_req, $p_count){
        $query = "INSERT INTO pos_info (`p_id`, `d_id`, `p_name`, `p_date`, `p_req`, `p_count`) VALUES
                    ( default, '$p_department', '$p_name', '$p_date', '$p_req', '$p_count')";

        return $query;
    }
    
    /**
     * Insert interviewer into the database
     * Found in : interviewer_validation
     */
    function insert_interviewer($i_name, $i_email){
        $query = "INSERT INTO int_info (`i_id`, `i_name`, `i_eaddr`) VALUES
                    ( default, '$i_name', '$i_email')";

        return $query;
    }

    /**
     * Insert source into the database
     * Found in : source_validation
     */
    function insert_source($s_name){
        $query = "INSERT INTO src_info (`s_id`, `s_name`) VALUES
                    ( default, '$s_name')";

        return $query;
    }

    /**
     * Insert IFF in the Approval database
     * Found in : iff_validation
     */
    function insert_iff($c_id, $i_id, $sme, $com, $pro, $cog, $sol, $int, $own, $lead, $dl, $total, $poscom, $negcom, $overcom, $date, $status, $phase){
        $query = "INSERT INTO iff_int (`iff_int_id`, `c_id`, `i_id`, `iff_sme`, `iff_com`, `iff_pro`, `iff_cog`, `iff_sol`, `iff_int`, `iff_own`, `iff_lead`, `iff_ddl`, `iff_total`, `iff_poscom`, `iff_negcom`, `iff_allcom`, `iff_date`, `iff_status`, `iff_phase`) VALUES
                    ( default, '$c_id', '$i_id', '$sme', '$com', '$pro', '$cog', '$sol', '$int', '$own', '$lead', '$dl', '$total', '$poscom', '$negcom', '$overcom', '$date', '$status', '$phase')";

        return $query;
    }

    /**
     * Insert Approval IFF into int_scores
     * Foudn in : approval_validation
     */
    function insert_int_scores($iff_id){
        $query = "INSERT INTO int_scores ( `c_id`, `i_id`, `sme`, `com`, `pro`, `cog`, `sol`, `int_int`, `own`, `lead`, `ddl`, `total`, `poscom`, `negcom`, `allcom`, `int_date`, `status`, `phase` )
                    SELECT c_id, i_id, iff_sme, iff_com, iff_pro, iff_cog, iff_sol, iff_int, iff_own, iff_lead, iff_ddl, iff_total, iff_poscom, iff_negcom, iff_allcom, iff_date, iff_status, iff_phase 
                    FROM iff_int 
                    WHERE iff_int_id = '$iff_id'";

        return $query;
    }

    /**
     * Insert total target hire value into dash_info
     * Foudn in : index.php
     */
    function insert_tth_value($tth, $date){
        $query = "INSERT INTO dash_info (dash_id, dash_value, dash_date) VALUES (default, '$tth', '$date')";

        return $query;
    }

    /**
     * Copy all cognitive assessment data from old profile to new reprofile
     * found in: listofcandidates_validation.php
     */
    function insert_reprof_cog($c_id,$id){
        $query = "INSERT INTO `cog_pre` (`c_id`, `cog_1`, `cog_2`, `raw_1`, `raw_2`, `verb_1`, `verb_2`, `num_1`, `num_2`, `abs_1`, `abs_2`, `dom_bird`, `dove`, `owl`, `peacock`, `eagle`, `beh_pro`, `beh_cat`, `beh_a`, `beh_b`, `beh_c`, `beh_d`, `beh_ab`, `beh_ac`, `beh_ad`, `beh_bc`, `beh_bd`, `beh_cd`)
        SELECT $id, `cog_1`, `cog_2`, `raw_1`, `raw_2`, `verb_1`, `verb_2`, `num_1`, `num_2`, `abs_1`, `abs_2`, `dom_bird`, `dove`, `owl`, `peacock`, `eagle`, `beh_pro`, `beh_cat`, `beh_a`, `beh_b`, `beh_c`, `beh_d`, `beh_ab`, `beh_ac`, `beh_ad`, `beh_bc`, `beh_bd`, `beh_cd` FROM cog_pre WHERE c_id = $c_id";

        return $query;
        

    }

    //========================================================================
    // DELETE FUNCTIONS

    /**
     * Delete employee in the database
     * Found in : profile_validation
     */
    function delete_employee($id){
        $query = "DELETE FROM user_info WHERE u_id = '$id'";

        return $query;
    }

    /**
     * Delete department in the database
     * Found in : department_validation
     */
    function delete_department($d_id){
        $query = "DELETE FROM dep_info WHERE d_cid = '$d_id'";

        return $query;
    }

    /**
     * Delete position in the database
     * Found in : position_validation
     */
    function delete_position($p_id){
        $query = "DELETE FROM pos_info WHERE p_cid = '$p_id'";

        return $query;
    }

    /**
     * Delete interviewer in the database
     * Found in : interviewer_validation
     */
    function delete_interviewer($i_id){
        $query = "UPDATE int_info SET retired = '1' WHERE i_cid = '$i_id'";

        return $query;
    }

    /**
     * Delete source in the database
     * Found in : source_validation
     */
    function delete_source($s_id){
        $query = "UPDATE src_info SET retired = '1' WHERE s_cid = '$s_id'";

        return $query;
    }

    /**
     * Delete pending approval in the database
     * Found in : approval_validation
     */
    function delete_int_scores($iff_id){
        $query = "DELETE FROM iff_int WHERE iff_int_id = '$iff_id'";

        return $query;
    }

    //========================================================================
    // MISCELLANEOUS FUNCTIONS

    /**
     * lorem
     */
    function pass_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_padate = '$date', c_job = '' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
    */
    function job_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_job = '0', c_jdate = '$date' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
     */
    function job_accept_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_job = '1', c_jdate = '$date' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
     */
    function job_decline_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_job = '2', c_jdate = '$date' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
    */
    function unresponsive_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_udate = '$date', c_job = '' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
    */
    function pool_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_podate = '$date', c_job = '' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
    */
    function fail_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_fdate = '$date', c_job = '' WHERE c_id = '$c_id'";

        return $query;
    }

    /**
     * lorem
    */
    function withdrawn_candidate($c_id, $date){
        $query = "UPDATE cand_info SET c_wdate = '$date', c_job = '' WHERE c_id = '$c_id'";

        return $query;
    }

    function fetch_week($week, $year) {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $weeek['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $weeek['week_end'] = $dto->format('Y-m-d');
        return $weeek;
      }

    
    
    
    /**
     * Check the value of IFF candidate score
     * Found in: iff_data.php
     * 
     */

    function iff_validate_score($scores,$val){
        
        if($scores == $val){
            $scores = 'checked';
        }
        else if($scores == NULL){
            $scores = '';
        }
        else
            $scores = 'onclick="return false;" unchecked';


        return $scores;
    }

    /**
     * Validate if comment section is empty or not
     * Found in: iff_data.php
     */
    function iff_validate_com($comment){
        if(!empty($comment)){
            $comment = 'readonly';
        }
        else{
            $comment = '';
        }

        return $comment;
    }

    /**
     * Get Name for the Phase dropdown
     * Found in: iff_data.php
     */

    function phase_name($names){
        if($names == 1){
            $names = 'Initial';
        }
        else if($names == 2){
            $names = 'Operation - Team Lead';
        }
        else if($names == 3){
            $names = 'Exam';
        }
        else if($names == 4){
            $names = 'Operation - Manager';
        }
        else if($names == 5){
            $names = 'Department Head';
        }
        else if($names == 6){
            $names = 'Client';
        }
        else if($names == 7){
            $names = 'Management';
        }

        return $names;
    }
    

    //   Counting number of applicant - report.php

    function weekly_sql_query($depid, $posid, $filterdate){
        include 'conn.php';
        if($depid != 0 && $posid != 0){

            if($filterdate == 0){
                $query = "SELECT cp.beh_cat as behavorial,cp.cog_1, c.c_id, d.*, p.p_id 
                FROM cog_pre cp, cand_info c, dep_info d, pos_info p 
                WHERE c.d_id = $depid AND c.p_id = $posid AND d.d_id = $depid
                AND p.p_id = $posid AND c.c_id = cp.c_id";
            }
            else {
                $query = "SELECT cp.beh_cat as behavorial,cp.cog_1, c.c_id, d.*, p.p_id 
                FROM cog_pre cp, cand_info c, dep_info d, pos_info p 
                WHERE c.d_id = $depid AND c.p_id = $posid AND d.d_id = $depid
                AND p.p_id = $posid AND c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate";
            }
            
        }
        else if($depid != 0 && $posid == 0){
            if($filterdate == 0){
                $query = "SELECT cp.*,c.*,d.* 
                FROM cog_pre cp, cand_info c, dep_info d 
                WHERE c.d_id = $depid AND d.d_id = $depid AND c.c_id = cp.c_id";
            }
            else {
                $query = "SELECT cp.*,c.*,d.* 
                FROM cog_pre cp, cand_info c, dep_info d 
                WHERE c.d_id = $depid AND d.d_id = $depid AND c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate";
            }
        }
        else if($depid == 0 && $posid != 0){
            if($filterdate == 0){
                $query = "SELECT cp.*,c.*,p.* 
                FROM cog_pre cp, cand_info c, pos_info p 
                WHERE c.p_id = $posid AND p.p_id = $posid AND c.c_id = cp.c_id";
            }
            else {
                $query = "SELECT cp.*,c.*,p.* 
                FROM cog_pre cp, cand_info c, pos_info p 
                WHERE c.p_id = $posid AND p.p_id = $posid AND c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate";
            }
        }
        else{
           if($filterdate == 0){
                $query = "SELECT *,cp.* 
                FROM cand_info, cog_pre cp WHERE cand_info.c_id = cp.c_id";
           }
           else {
                $query = "SELECT *,cp.* 
                FROM cand_info, cog_pre cp WHERE cand_info.c_id = cp.c_id AND YEAR(c_appli) = $filterdate";
           }
        }
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function behevorial_sql_query($depid,$posid,$b_diff, $filterdate){
        include 'conn.php';
            if($depid != 0 && $posid != 0){
                        if($filterdate == 0){
                            $query ="SELECT a.behavorial, COUNT(a.behavorial) FROM
                        (
                            SELECT $b_diff as behavorial, c.c_id, d.*, p.p_id 
                                FROM cog_pre cp, cand_info c, dep_info d, pos_info p 
                                WHERE c.d_id = $depid AND c.p_id = $posid AND d.d_id = $depid
                                AND p.p_id = $posid AND c.c_id = cp.c_id
                        ) AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
                else {
                    $query ="SELECT a.behavorial, COUNT(a.behavorial) FROM
                    (
                        SELECT $b_diff as behavorial, c.c_id, d.*, p.p_id 
                            FROM cog_pre cp, cand_info c, dep_info d, pos_info p 
                            WHERE c.d_id = $depid AND c.p_id = $posid AND d.d_id = $depid
                            AND p.p_id = $posid AND c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate
                    ) AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
            }
            else if($depid == 0 && $posid != 0){
                
                if($filterdate == 0){
                    $query = "SELECT a.behavorial, COUNT(a.behavorial) FROM 
                    (SELECT $b_diff as behavorial,c.c_name, c.c_id, p.p_id 
                    FROM cog_pre cp, cand_info c, pos_info p  
                    WHERE c.p_id = $posid AND p.p_id = $posid AND c.c_id = cp.c_id)
                    AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
                else {
                    $query = "SELECT a.behavorial, COUNT(a.behavorial) FROM 
                    (SELECT $b_diff as behavorial,c.c_name, c.c_id, p.p_id 
                    FROM cog_pre cp, cand_info c, pos_info p  
                    WHERE c.p_id = $posid AND p.p_id = $posid AND c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate)
                    AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
            }
            else if($depid != 0 && $posid == 0){
                if($filterdate == 0){
                    $query = "SELECT a.behavorial, COUNT(a.behavorial) FROM 
                    (SELECT $b_diff as behavorial,c.c_name, c.c_id, d.d_id 
                    FROM cog_pre cp, cand_info c, dep_info d 
                    WHERE c.d_id = $depid AND d.d_id = $depid AND c.c_id = cp.c_id)
                    AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
                else {
                    $query = "SELECT a.behavorial, COUNT(a.behavorial) FROM 
                    (SELECT $b_diff as behavorial,c.c_name, c.c_id, d.d_id 
                    FROM cog_pre cp, cand_info c, dep_info d 
                    WHERE c.d_id = $depid AND d.d_id = $depid AND c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate) 
                    AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
            }
            else {
                if($filterdate == 0){
                    $query ="SELECT a.behavorial, COUNT(a.behavorial) FROM
                    (
                    SELECT $b_diff as behavorial, c.c_id, d.*, p.p_id 
                        FROM cog_pre cp, cand_info c, dep_info d, pos_info p
                    ) AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
                else {
                        $query ="SELECT a.behavorial, COUNT(a.behavorial) FROM
                    (
                    SELECT $b_diff as behavorial, c.c_id, d.*, p.p_id 
                        FROM cog_pre cp, cand_info c, dep_info d, pos_info p WHERE YEAR(c.c_appli) = $filterdate AND c.c_id = cp.c_id
                    ) AS a GROUP BY a.behavorial ORDER BY COUNT(a.behavorial) DESC LIMIT 1";
                }
            }
            $result = mysqli_query($conn, $query);
            return $result;
    }

    function numApp($depid, $posid, $filterdate){
        $result = weekly_sql_query($depid, $posid, $filterdate);
        return mysqli_num_rows($result);
    }

    // get average cognitive score - report.php
    function avg_cog($depid, $posid, $filterdate){
        $avgcog = array();
        $result = weekly_sql_query($depid, $posid, $filterdate);
        while($row=mysqli_fetch_assoc($result)){
            array_push($avgcog, $row['cog_1']);
        }
        $total = 0;
        if(!empty($avgcog))
            $total = array_sum($avgcog)/count($avgcog);
        return floor($total);
    }


    // get most behavorial profile - report.php
    function avg_beh_prof($depid, $posid, $filterdate){
        include 'conn.php';
        $arr_list2 = array();
        $total = 0;
        $result = behevorial_sql_query($depid, $posid,'cp.beh_pro', $filterdate);
        while($row = mysqli_fetch_assoc($result)){
            $total = $row['behavorial'];
        }
        return $total;
    }

    // get most behavorial categ - report.php
    function avg_beh_cat($depid, $posid, $filterdate){
        $total = 0;
        $result = behevorial_sql_query($depid, $posid,'cp.beh_cat', $filterdate);
        while($row = mysqli_fetch_assoc($result)){
            $total = $row['behavorial'];
        }
        return $total;
    }

    function weekly_list_dept(){
        include 'conn.php';
        $query = "SELECT * FROM dep_info";
        $result = mysqli_query($conn, $query);
        $arr_list = array();
        while($row = mysqli_fetch_assoc($result)){
            if($row['d_name'] == 'Business Development'){
                $row['d_name'] = 'BizDev';
                array_push($arr_list, $row);
            }
            if($row['d_name'] == 'Data & Technology'){
                $row['d_name'] = 'D&T';
                array_push($arr_list, $row);
            }
            if($row['d_name'] == 'Finance & Administrative Services'){
                $row['d_name'] = 'FAAS';
                array_push($arr_list, $row);
            }
            if(str_contains($row['d_name'], 'Operations')){
                $row['d_name'] = 'OPS';
                array_push($arr_list,$row);
            }
            if($row['d_name'] == 'People Services'){
                $row['d_name'] = 'PS';
                array_push($arr_list, $row);
            }
        }

        return $arr_list;
    }

    function weekly_list_pos(){
        include 'conn.php';
        $query = "SELECT * FROM pos_info";
        $result = mysqli_query($conn, $query);
        $arr_list = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($arr_list, $row);
        }
        return $arr_list;
    }

    function weeklyChart($depid,$posid,$filterdate){
        include 'conn.php';
        
        // if($x !=0 && $y !=0){
        //     $query = "SELECT a.platname, COUNT(a.platname) as count_status FROM 
        //     (SELECT c.c_name, c.s_id,d.d_id,s.s_name as platname, p.p_id
        //         FROM cand_info c, dep_info d, src_info s, pos_info p 
        //         WHERE c.d_id = $x AND d.d_id = $x AND c.p_id = $y AND p.p_id = $y AND c.s_id = s.s_id)
        //     AS a GROUP BY a.platname ORDER BY plat2";
        // }
        // if($x != 0 && $y == 0){
        //     $query = "SELECT a.platname, COUNT(a.platname) as plat2 FROM 
        //     (SELECT c.c_name, c.s_id,d.d_id,s.s_name as platname
        //         FROM cand_info c, dep_info d, src_info s 
        //         WHERE c.d_id = $x AND d.d_id = $x AND c.s_id = s.s_id)
        //     AS a GROUP BY a.platname ORDER BY plat2";
        // }
        // else if($x == 0 && $y != 0) {
        //     $query = "SELECT a.platname, COUNT(a.platname) as plat2 FROM 
        //     (SELECT c.c_name, c.s_id,p.p_id,s.s_name as platname
        //         FROM cand_info c, pos_info p, src_info s 
        //         WHERE c.p_id = $y AND p.p_id = $y AND c.s_id = s.s_id)
        //     AS a GROUP BY a.platname ORDER BY plat2";
        // }
        if ($depid != 0 && $posid != 0){
            if($filterdate == 0){
                $query = "SELECT s.s_name as name1, COUNT(s.s_name) as count_status
                FROM cand_info c, dep_info d, src_info s, pos_info p 
                WHERE c.d_id = $depid  AND d.d_id = $depid  AND c.p_id = $posid AND p.p_id = $posid AND c.s_id = s.s_id
                GROUP BY name1 ORDER BY name1";
            }
            else{
                $query = "SELECT s.s_name as name1, COUNT(s.s_name) as count_status
                FROM cand_info c, dep_info d, src_info s, pos_info p 
                WHERE c.d_id = $depid  AND d.d_id = $depid  AND c.p_id = $posid AND p.p_id = $posid AND c.s_id = s.s_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY name1";
            }
        }
        else if($depid != 0 && $posid == 0){
            if($filterdate == 0){
                $query = "SELECT s.s_name as name1, COUNT(s.s_name) as count_status
                FROM cand_info c, dep_info d, src_info s
                WHERE c.d_id = $depid AND d.d_id = $depid AND c.s_id = s.s_id
                GROUP BY name1 ORDER BY name1";
            }
            else{
                $query = "SELECT s.s_name as name1, COUNT(s.s_name) as count_status
                FROM cand_info c, dep_info d, src_info s
                WHERE c.d_id = $depid AND d.d_id = $depid AND c.s_id = s.s_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY name1";
            }
        }
        else if($posid != 0 && $depid == 0){
            if($filterdate == 0){
                $query = "SELECT s.s_name as name1, COUNT(s.s_name) as count_status
                FROM cand_info c, pos_info p, src_info s
                WHERE c.p_id = $posid AND p.p_id = $posid AND c.s_id = s.s_id
                GROUP BY name1 ORDER BY name1";
            }
            else{
                $query = "SELECT s.s_name as name1, COUNT(s.s_name) as count_status
                FROM cand_info c, pos_info p, src_info s
                WHERE c.p_id = $posid AND p.p_id = $posid AND c.s_id = s.s_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY name1";
            }
        }
        else {
            if($filterdate == 0){
                $query = "SELECT s.s_name as name1, COUNT(c.s_id) as count_status FROM cand_info c, src_info s WHERE c.s_id = s.s_id
                GROUP BY name1 ORDER BY name1";
            }
            else{
                $query = "SELECT s.s_name as name1, COUNT(c.s_id) as count_status FROM cand_info c, src_info s WHERE c.s_id = s.s_id  AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY name1";
            }
        }
        return find_by_sql($query);
    }

    function appStage($depid, $posid, $filterdate){
        include 'conn.php';
        if($depid != 0 && $posid != 0){
            if($filterdate == 0){
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    WHERE c_info.p_id = $posid AND c_info.d_id = $depid
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
            else{
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    WHERE c_info.p_id = $posid AND c_info.d_id = $depid AND YEAR(c_info.c_appli) = $filterdate
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
        }
        else if($posid != 0 && $depid == 0){
            if($filterdate == 0){
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    WHERE c_info.p_id = $posid
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
            else{
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    WHERE c_info.p_id = $posid AND YEAR(c_info.c_appli) = $filterdate
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
        }
        else if($depid != 0 && $posid == 0){
            if($filterdate == 0){
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    WHERE c_info.d_id = $depid
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
            else{
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    WHERE c_info.d_id = $depid AND YEAR(c_info.c_appli) = $filterdate
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }

        }
        else {
            if($filterdate == 0){
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
            else{
                $query = "SELECT a.phase as name1, COUNT(a.phase) AS `count_status` FROM
                (
                    SELECT i_info.c_id, MAX(i_info.phase) AS `phase`, c_info.p_id
                    FROM int_scores i_info 
                    LEFT JOIN cand_info c_info
                    ON i_info.c_id = c_info.c_id WHERE YEAR(c_info.c_appli) = $filterdate
                    GROUP BY c_id
                ) AS a GROUP BY name1;";
            }
        }
        return find_by_sql($query);
    }

    function appStatus($depid, $posid, $filterdate){
        include 'conn.php';
        $qwe2 = 'p_id = '.$posid.' AND ';
        if($depid != 0 && $posid != 0){
            if($filterdate == 0){
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status, d_id, p_id FROM cand_info 
                WHERE p_id = $posid AND d_id = $depid 
                GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status, d_id, p_id FROM cand_info 
                WHERE p_id = $posid AND d_id = $depid AND YEAR(c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status";
            }
        }
        else if($depid != 0 && $posid == 0){
            if($filterdate == 0){
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status FROM cand_info 
                WHERE d_id = $depid
                GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status FROM cand_info 
                WHERE d_id = $depid AND YEAR(c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status";
            }
        }
        else if($posid != 0 && $depid == 0){
            if($filterdate == 0){
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status FROM cand_info 
                WHERE p_id = $posid
                GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status FROM cand_info 
                WHERE p_id = $posid AND YEAR(c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status";
            }
        }
        else {
            if($filterdate == 0){
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status, d_id, p_id FROM cand_info 
                GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT c_actpas as name1, COUNT(c_actpas) as count_status, d_id, p_id FROM cand_info
                WHERE YEAR(c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status";
            }
        }
        return find_by_sql($query);
    }

    function domChart($depid, $posid, $filterdate){
        include 'conn.php';
        
        if($depid != 0 && $posid !=0){
            if($filterdate == 0){
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE c.d_id = $depid AND c.p_id = $posid AND cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE c.d_id = $depid AND c.p_id = $posid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate GROUP BY name1 ORDER BY count_status";
            }
        }
        else if($depid != 0 && $posid == 0){
            if($filterdate == 0){
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE c.d_id = $depid AND cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE c.d_id = $depid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate GROUP BY name1 ORDER BY count_status";
            }
        }
        else if($depid == 0 && $posid !=0) {
            if($filterdate == 0){
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE c.p_id = $posid AND cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE c.p_id = $posid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate GROUP BY name1 ORDER BY count_status";
            }
        }
        else {
            if($filterdate == 0){
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else {
                $query = "SELECT cp.dom_bird as name1, COUNT(cp.dom_bird) as count_status FROM cand_info c, cog_pre cp
                WHERE cp.c_id = c.c_id GROUP BY name1 AND YEAR(c.c_appli) = $filterdate ORDER BY count_status";
            }
        }
        return find_by_sql($query);
    }

    function finalChart($depid, $posid, $filterdate){
        include 'conn.php';
        if($depid != 0 && $posid != 0){
            if($filterdate == 0){
                $query = "SELECT cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.p_id = $posid AND c.d_id = $depid AND cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.p_id = $posid AND c.d_id = $depid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate GROUP BY name1 ORDER BY count_status";
            }
        }
        else if($depid != 0 && $posid == 0){
            if($filterdate == 0){
                $query = "SELECT cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.d_id = $depid AND cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.d_id = $depid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate GROUP BY name1 ORDER BY count_status";
            }
        }
        else if($depid == 0 && $posid != 0){
            if($filterdate == 0){
                $query = "SELECT cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.p_id = $posid AND cp.c_id = c.c_id GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.p_id = $posid AND cp.c_id = c.c_id AND YEAR(c.c_appli) = $filterdate GROUP BY name1 ORDER BY count_status";
            }
        }
        else{
            if($filterdate == 0){
                $query = "SELECT cp.c_id, cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.c_id = cp.c_id
                GROUP BY name1 ORDER BY count_status";
            }
            else{
                $query = "SELECT cp.c_id, cp.status as name1, COUNT(cp.status) as count_status FROM cand_info c, int_scores cp
                WHERE c.c_id = cp.c_id AND YEAR(c.c_appli) = $filterdate
                GROUP BY name1 ORDER BY count_status";
            }
        }
        return find_by_sql($query);
    }
?>