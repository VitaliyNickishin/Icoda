<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="section-title"><?php the_field('section_7_title_block-new-en', $args['post_id']); ?></h3>
        </div>
    </div>
    <div class="list-leadership-desktop">
        <div class="row list-leadership">
            <?php
            $team_members = get_field('section_7-new_list-en', $args['post_id']);
            if(!empty($team_members)) :
                foreach ($team_members as $item) : ?>
                    <div class="col-lg-3">
                        <div class="list-leadership-item">

                            <div class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>" style="background-image:url(<?php echo $item['image']; ?>);"></div>
                            <div class="leadership-item-des">
                                <div class="title-wrap d-flex justify-content-between w-100">
                                    <span class="h6"><?= $item['name']; ?></span>

                                    <span class="leadership-contact-icons m-0">
                                        <?php echo ($item['author_page'] ? '<a href="' . $item['author_page'] . '"><i class="fas fa-user"></i></a>' : ''); ?>
                                    </span>
                                </div>
                                <div class="position-twitter-block">
                                    <span class="leadership-des-position"><?= $item['position']; ?> </span>
                                </div>

                                <span class="leadership-des-text"><?= $item['desc']; ?></span>

                                <div class="leadership-social">
                                    <div class="btn-twitter">
                                        <?php if (!empty($item['twitter'])) : ?>
                                            <span class="leadership-des-twitter">
                                                <a class="btn" href="<?= $item['twitter']; ?>" target="_blank">
                                                    <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.8067 2.17427C12.3544 2.37469 11.8685 2.5101 11.3577 2.57131C11.8847 2.25595 12.279 1.75961 12.467 1.1749C11.9719 1.46901 11.4299 1.67604 10.8648 1.78698C10.4847 1.3812 9.98135 1.11224 9.43279 1.02186C8.88422 0.931482 8.32116 1.02474 7.83103 1.28716C7.3409 1.54957 6.95111 1.96647 6.72219 2.47311C6.49327 2.97975 6.43803 3.5478 6.56503 4.08906C5.56169 4.03868 4.58016 3.7779 3.68413 3.32364C2.78811 2.86937 1.99761 2.23177 1.36394 1.45223C1.14728 1.82598 1.02269 2.25931 1.02269 2.72081C1.02245 3.13627 1.12476 3.54536 1.32054 3.91179C1.51633 4.27822 1.79953 4.59067 2.14503 4.8214C1.74434 4.80865 1.3525 4.70038 1.00211 4.5056V4.5381C1.00207 5.1208 1.20363 5.68556 1.57258 6.13656C1.94154 6.58756 2.45517 6.89702 3.02632 7.01244C2.65462 7.11303 2.26492 7.12785 1.88665 7.05577C2.0478 7.55714 2.36169 7.99558 2.78439 8.30969C3.20709 8.6238 3.71744 8.79787 4.24399 8.80752C3.35015 9.5092 2.24626 9.88982 1.1099 9.88814C0.908608 9.8882 0.707485 9.87644 0.507568 9.85294C1.66103 10.5946 3.00375 10.9882 4.37507 10.9866C9.01715 10.9866 11.5549 7.14189 11.5549 3.8074C11.5549 3.69906 11.5522 3.58964 11.5473 3.48131C12.0409 3.12434 12.467 2.6823 12.8056 2.1759L12.8067 2.17427Z" fill="currentColor" />
                                                    </svg>
                                                    Twitter
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="btn-linkedin">
                                        <?php if (!empty($item['link'])) : ?>
                                            <a class="btn" href="<?php echo $item['link']; ?>" target="_blank">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.178 14V4.55423H0.176939V14H3.178ZM1.67786 3.26379C2.72438 3.26379 3.37579 2.53846 3.37579 1.63205C3.35629 0.705194 2.72442 0 1.69772 0C0.671174 0 -0.00012207 0.705208 -0.00012207 1.63205C-0.00012207 2.53851 0.651127 3.26379 1.65826 3.26379H1.67776H1.67786ZM4.83907 14H7.84013V8.72502C7.84013 8.44271 7.85963 8.16069 7.93888 7.95888C8.15583 7.39484 8.64963 6.81065 9.47865 6.81065C10.5646 6.81065 10.999 7.67685 10.999 8.94665V13.9999H13.9999V8.58382C13.9999 5.68244 12.5194 4.33247 10.5448 4.33247C8.92589 4.33247 8.21506 5.27917 7.82017 5.92397H7.8402V4.55403H4.83914C4.87852 5.44037 4.83914 13.9998 4.83914 13.9998L4.83907 14Z" fill="currentColor" />
                                                </svg>
                                                LinkedIn
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- slider -->
    <div class="list-leadership-mobile">
        <div class="list-leadership">
            <div class="leadership-slider custom-slider">
                <?php if(!empty($team_members)) : ?>
                    <?php foreach ($team_members as $item) : ?>

                        <div class="list-leadership-item">
                            <div class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>" style="background-image:url(<?php echo $item['image']; ?>);"></div>
                            <div class="leadership-item-des">
                                <div class="title-wrap d-flex justify-content-between w-100">
                                    <span class="h6"><?= $item['name']; ?></span>

                                    <span class="leadership-contact-icons m-0">
                                        <?php echo ($item['author_page'] ? '<a href="' . $item['author_page'] . '"><i class="fas fa-user"></i></a>' : ''); ?>
                                    </span>
                                </div>
                                <div class="position-twitter-block">
                                    <span class="leadership-des-position"><?= $item['position']; ?> </span>
                                </div>

                                <span class="leadership-des-text"><?= $item['desc']; ?></span>

                                <div class="leadership-social">
                                    <div class="btn-twitter">
                                        <?php if (!empty($item['twitter'])) : ?>
                                            <span class="leadership-des-twitter">
                                                <a class="btn" href="<?= $item['twitter']; ?>" target="_blank">
                                                    <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.8067 2.17427C12.3544 2.37469 11.8685 2.5101 11.3577 2.57131C11.8847 2.25595 12.279 1.75961 12.467 1.1749C11.9719 1.46901 11.4299 1.67604 10.8648 1.78698C10.4847 1.3812 9.98135 1.11224 9.43279 1.02186C8.88422 0.931482 8.32116 1.02474 7.83103 1.28716C7.3409 1.54957 6.95111 1.96647 6.72219 2.47311C6.49327 2.97975 6.43803 3.5478 6.56503 4.08906C5.56169 4.03868 4.58016 3.7779 3.68413 3.32364C2.78811 2.86937 1.99761 2.23177 1.36394 1.45223C1.14728 1.82598 1.02269 2.25931 1.02269 2.72081C1.02245 3.13627 1.12476 3.54536 1.32054 3.91179C1.51633 4.27822 1.79953 4.59067 2.14503 4.8214C1.74434 4.80865 1.3525 4.70038 1.00211 4.5056V4.5381C1.00207 5.1208 1.20363 5.68556 1.57258 6.13656C1.94154 6.58756 2.45517 6.89702 3.02632 7.01244C2.65462 7.11303 2.26492 7.12785 1.88665 7.05577C2.0478 7.55714 2.36169 7.99558 2.78439 8.30969C3.20709 8.6238 3.71744 8.79787 4.24399 8.80752C3.35015 9.5092 2.24626 9.88982 1.1099 9.88814C0.908608 9.8882 0.707485 9.87644 0.507568 9.85294C1.66103 10.5946 3.00375 10.9882 4.37507 10.9866C9.01715 10.9866 11.5549 7.14189 11.5549 3.8074C11.5549 3.69906 11.5522 3.58964 11.5473 3.48131C12.0409 3.12434 12.467 2.6823 12.8056 2.1759L12.8067 2.17427Z" fill="currentColor" />
                                                    </svg>
                                                    Twitter
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="btn-linkedin">
                                        <?php if (!empty($item['link'])) : ?>
                                            <a class="btn" href="<?php echo $item['link']; ?>" target="_blank">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.178 14V4.55423H0.176939V14H3.178ZM1.67786 3.26379C2.72438 3.26379 3.37579 2.53846 3.37579 1.63205C3.35629 0.705194 2.72442 0 1.69772 0C0.671174 0 -0.00012207 0.705208 -0.00012207 1.63205C-0.00012207 2.53851 0.651127 3.26379 1.65826 3.26379H1.67776H1.67786ZM4.83907 14H7.84013V8.72502C7.84013 8.44271 7.85963 8.16069 7.93888 7.95888C8.15583 7.39484 8.64963 6.81065 9.47865 6.81065C10.5646 6.81065 10.999 7.67685 10.999 8.94665V13.9999H13.9999V8.58382C13.9999 5.68244 12.5194 4.33247 10.5448 4.33247C8.92589 4.33247 8.21506 5.27917 7.82017 5.92397H7.8402V4.55403H4.83914C4.87852 5.44037 4.83914 13.9998 4.83914 13.9998L4.83907 14Z" fill="currentColor" />
                                                </svg>
                                                LinkedIn
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="wr-control wr-control-leadership"></div>
        </div>
    </div>
</div>