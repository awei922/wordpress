<div class="wrap bookplus-wrap" id="bookplus-app">

    <h1 class="wp-heading-inline"><?php _e( 'Bookplus Catalogs', 'bookplus' ); ?></h1>
    <a class="page-title-action" href="#" v-on:click.prevent="addCatalog">
        <?php _e( 'Add New', 'bookplus' ); ?>
    </a>
    <hr class="wp-header-end">

<!--    <pre>{{ $data | json }}</pre>-->

    <div class="col-container wp-clearfix">
        <div id="col-left" v-if="post">
            <div class="col-wrap">
                <div class="post-body">
                    <h3>
                        <a target="_blank" :href="post.caps.edit ? editUrl + post.id : '#'">
                            <strong>{{ post.title }}</strong>
                            <span v-if="post.status != postStatus" class="post-status">{{ post.status }}</span>
                        </a>
                        <span class="row-actions">
                            <a target="_blank" :href="viewUrl + post.id"><span class="dashicons dashicons-external"></span></a>
                            <span v-on:click.prevent="addSection(post)" class="dashicons dashicons-plus-alt"></span>
                        </span>
                    </h3>
                    <ul class="sections" v-sortable>
                        <template v-if="post.children.length">
                            <li v-for="(section, index) in post.children" :data-id="section.id" v-on:click="toggleCollapse">
                                <div class="section-title">
                                    <a target="_blank" :href="section.caps.edit ? editUrl + section.id : '#'">
                                        <strong>{{ section.title }}</strong>
                                        <span v-if="section.status != postStatus" class="post-status">{{ section.status }}</span>
                                        <span v-if="section.children.length > 0" class="count">{{ section.children.length }}</span>
                                    </a>

                                    <span class="row-actions">
                                        <span class="dashicons dashicons-menu"></span>
                                        <a target="_blank" :href="viewUrl + section.id"><span class="dashicons dashicons-external"></span></a>
                                        <span v-if="section.caps.delete" v-on:click="deleteSection(index, post.children)" class="dashicons dashicons-trash"></span>
                                        <span  v-on:click="addArticle(section,$event)" class="dashicons dashicons-plus-alt"></span>
                                    </span>
                                </div>
                                <ul class="articles collapsed" v-if="section.children" v-sortable>
                                    <li class="article" v-for="(article, index) in section.children" :data-id="article.id">
                                        <a target="_blank" :href="article.caps.edit ? editUrl + article.id : '#'">
                                            <strong>{{ article.title }}</strong>
                                            <span v-if="article.status != postStatus" class="post-status">{{ article.status }}</span>
                                        </a>
                                        <span class="row-actions">
                                            <span class="dashicons dashicons-menu"></span>
                                            <a target="_blank" :href="viewUrl + article.id"><span class="dashicons dashicons-external"></span></a>
                                            <span v-if="article.caps.delete" v-on:click="deleteArticle(index, section.children)" class="dashicons dashicons-trash"></span>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                        </template>
                        <li v-else>
                            <div class="section-title">
                                <?php _e( 'No results found.' ,'bookplus' ); ?>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div><!-- /col-left -->

        <div id="col-right" :style="!post ? 'width:100%;margin-left:-6px;float:none' : ''">
            <div class="col-wrap">
                <table class="wp-list-table widefat fixed striped tags">
                    <thead>
                        <tr>
                            <th><?php _e( 'Title','bookplus'  ); ?></th>
                            <th class="column-posts"><?php _e( 'ID','bookplus'  ); ?></th>
                        </tr>
                    </thead>

                    <tbody v-sortable>
                        <template v-if="posts.length">
                            <tr v-for="(post, index) in posts" :data-id="post.id">
                                <td>
                                    <a :href="post.caps.edit ? catalogUrl + post.id : '#'">
                                        <strong>{{ post.title }}</strong>
                                        <span v-if="post.status != postStatus" class="post-status">{{ post.status }}</span>
                                    </a>
                                    <span class="row-actions">
                                        <a target="_blank" :href="viewUrl + post.id"><span class="dashicons dashicons-external"></span></a>
                                        <span v-if="post.caps.delete" v-on:click="deleteCatalog(index, posts)" class="dashicons dashicons-trash"></span>
                                        <span class="dashicons dashicons-menu"></span>
                                    </span>
                                </td>
                                <td>{{post.id}}</td>
                            </tr>
                        </template>
                        <tr v-else>
                            <td><?php _e( 'No results found.' ,'bookplus' ); ?></td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th><?php _e( 'Title' ,'bookplus' ); ?></th>
                            <th><?php _e( 'ID' ,'bookplus' ); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- /col-right -->

    </div><!-- /col-container -->
</div><!-- /wrap -->
