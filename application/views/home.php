        <div class="searchbar">
            <div class="hotsearch">
                <span class="hotsearch-title">
                    热门搜索
                </span>
                <?php foreach ($file_most as $file_item):?>
                <a href="view.php/<?php echo  ?>" class="hotsearch-content"><?php echo $file_item['file_name']; ?></a>
            </div>
            <div class="searchbor-1">
                <div class="zl">
                    <span class="search-selected">
                        全部
                    </span>
                    <ul class="search-select">
                        <li class="search-select-item" id="all" onmouseover="changecolor(0)" onmouseout="changecolorback()" onclick="searchselectchoose(0)">全部</li> 
                        <li class="search-select-item" id="doc" onmouseover="changecolor(1)" onmouseout="changecolorback()" onclick="searchselectchoose(1)">DOC</li>	   
                        <li class="search-select-item" id="pdf" onmouseover="changecolor(2)" onmouseout="changecolorback()" onclick="searchselectchoose(2)">PDF</li>	   
                        <li class="search-select-item" id="ppt" onmouseover="changecolor(3)" onmouseout="changecolorback()" onclick="searchselectchoose(3)">PPT</li>	   
                        <li class="search-select-item" id="txt" onmouseover="changecolor(4)" onmouseout="changecolorback()" onclick="searchselectchoose(4)">TXT</li>	   
                        <li class="search-select-item" id="rar" onmouseover="changecolor(5)" onmouseout="changecolorback()" onclick="searchselectchoose(5)">RAR</li>	   
                    </ul>
                </div>
                <div class="search-main">
                    <form action="#" class="search-form">
                        <input type="text" name="word" maxlength="30" class="search-input" />
                        <input type="submit" name="" class="search-button" value="查询" />
                    </form>
                </div>
                <div class="clear"></div>
            </div>

        </div>
		<!-- home-->
        <div class="home">
                <div class="home-a">
                	<div class="home-top">
                    	<div class="homecheck">我的信息</div>
                        <div class="homeuncheck">我的上传</div>
                    </div>
                    
                    <div class="home-down">
                    	<div class="homecheckdisplay">
                        	我的昵称：&nbsp;比利&nbsp; &nbsp;<a href="void(0)" onclick="" class="hrefclass">[修改]</a><br />
                            我的积分：&nbsp;⑨点<br />
                        </div>
                    	<div class="homeuncheckdisplay">
               		 	<div class="class-upload">        	
                            
                <div class="class-block">
                    <div class="class-right">
                    	<div class="class-right-title">
                        <a href="" class="class-right-title">巴拉巴拉拉blablah</a>
                        </div>
                        <div class="class-right-detail">2012-8-27&nbsp;	<a href="void(0)" onclick="" class="hrefclass">[修改]</a><a href="void(0)" onclick="" class="hrefclass">[删除]</a></div>
                    </div>
                </div>
              
             	<!--每页7个-->
                <div class="home-paging">
                <div class="home-paging-left"></div>
                <div class="home-paging-right"></div>
                </div>
                		</div>
                        </div>
                    </div>
                 </div>
        </div>      
        <!--home-->
