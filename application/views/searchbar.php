        <div class="searchbar">
            <div class="hotsearch">
                <span class="hotsearch-title">
                    热门搜索
                </span>
                <?php if (isset($file_most)): ?>
                <?php foreach ($file_most as $file): ?>
                <a href="" class="hotsearch-content"><?php echo $file['file_name'] ?></a>
                <?php endforeach; ?>
                <?php endif; ?>
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
                    <form class="search-form">
                        <input type="text" name="word" maxlength="100" class="search-input" id="search-text" />
                        <input type="button" id="search-button" class="search-button" value="查询" />
                    </form>
                </div>
                <div class="clear"></div>
            </div>
