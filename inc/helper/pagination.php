<?

function paginate( $con, $location, $getSearch='search', $serchVar, $request_str, $page=1, $reqOrder_str='name DESC' )
    {

        $serchVar     = $serchVar;
        $request_str  = $request_str;
        $reqOrder_str = $reqOrder_str;



        //-----Задаем стартовую страницу и защиту----------------------------
        if(!isset($_GET['page']) || !intval($page) )
            $page = 1;
        //--------------------------------------------------------------------


        if ($serchVar && !is_array ($serchVar) )
            {
                $result = $con->prepare($request_str) ;
                $result->execute([$serchVar]);
                $result = count( $result->fetchAll(PDO::FETCH_ASSOC) );
            }
        else if ($serchVar && is_array ($serchVar))
            {
                $result = $con->prepare($request_str);
                $result->execute($serchVar);
                $result = count( $result->fetchAll(PDO::FETCH_ASSOC) );
            }


        $page     = $page;
        $perPage  = 4;
        $num      = '';
        $nextArow = '';
        $prevArow = '';
        $pageSpan = 2;


        $relativEnd    = $page+$pageSpan;
        $relativeStart = $page-$pageSpan;
        $limitStart    = ($page-1)*$perPage;//---Начало десятка----
        $total         = $result;
        $pagesTotal    = ceil($total/$perPage);




        if($page<1)
            {
                $page=1;
            }
        else if($page>$pagesTotal)
            {
                $page=$pagesTotal;
            }

        if ($serchVar && !is_array ($serchVar))
            {

                $selected = $con->prepare( $request_str."
                                            ORDER BY    ".$reqOrder_str."
                                            LIMIT       ".$limitStart.",".$perPage." ") or die($con->error);
                $selected->execute([$serchVar]);
                $selected = $selected->fetchAll(PDO::FETCH_ASSOC);

            }
        if ($serchVar && is_array ($serchVar))
            {

                $selected = $con->prepare( $request_str."
                                            ORDER BY    ".$reqOrder_str."
                                            LIMIT       $limitStart,$perPage")
                                            or die($conTest->error);
                $selected->execute($serchVar);
                $selected = $selected->fetchAll(PDO::FETCH_ASSOC);
            }



        if( $serchVar )
            {
                if ($page>$pageSpan && $relativEnd<$pagesTotal)
                    {

                        for ($pg =$relativeStart; $pg <= $relativEnd ; $pg++)
                            {
                                $num.="<li><a href='".$location."?page=".$pg."&".$getSearch."=".$serchVar."'>$pg</a></li>".' ';
                            }
                    }
                elseif ($relativEnd>=$pagesTotal && $relativeStart>0 && $pagesTotal>$pageSpan*2)
                    {
                        for ($pg =$pagesTotal-2*$pageSpan; $pg <=$pagesTotal ;$pg++)
                        {
                            $num.="<li><a href='".$location."?page=".$pg."&".$getSearch."=".$serchVar."'>$pg</a></li>".' ';
                        }

                    }

                elseif($pagesTotal<=$pageSpan*2)
                    {
                        for ($pg =1; $pg <= $pagesTotal; $pg++)
                        {
                            $num.="<li><a href='".$location."?page=".$pg."&".$getSearch."=".$serchVar."'>$pg</a></li>".' ';
                        }
                    }
                else
                    {
                        for ($pg =1; $pg <= 2*$pageSpan+1; $pg++)
                        {
                            $num.="<li><a href='".$location."?page=".$pg."&".$getSearch."=".$serchVar."'>$pg</a></li>".' ';
                        }
                    }



                if ($page<$pagesTotal)
                    {
                        $next=$page+1;
                        $prevArow .="<a href='".$location."?page=".$next."&".$getSearch."=".$serchVar."'>Next</a>".' ';

                    }


                if ($page>1)
                    {
                        $prev=$page-1;
                        $nextArow.="<a href='".$location."?page=".$prev."&".$getSearch."=".$serchVar."'>Prev</a>".' ';

                    }


            }


        $returnVal  = [ 'num'        => $num,
                        'nextArow'   => $nextArow,
                        'prevArow'   => $prevArow,
                        'pagesTotal' => $pagesTotal,
                        'refStart'   => "<a href='".$location."?page= 1&".$getSearch."=".$serchVar."'>1</a>".' ',
                        'refEnd'     => "<a href='".$location."?page= ".$pagesTotal."&".$getSearch."=".$serchVar."'>$pagesTotal</a>".' ',
                        'total'      => $total,
                        'perPage'	 => $perPage,
                        'selected'   => $selected];



        return $returnVal;
    }