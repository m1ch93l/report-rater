<?php include 'includes/session.php'; ?>
<?php require_once 'includes/header.php';
require_once 'model/rating.php';
?>

<body>
    <header class="bg-dark py-3 text-white text-center">
        ReportRater
        <a type="button" hx-get="logout" hx-swap="outerHTML" hx-target="body" hx-trigger="click" hx-push-url="true"
            class="text-decoration-none text-white float-end h6 me-3 border p-1 text-capitalize">logout</a>
    </header>
    <div class="container-lg">
        <h5 class="text-center text-capitalize mb-1 mt-1">Welcome <?= $_SESSION['fullname'] ?> <i
                class="bi bi-emoji-smile"></i>!</h5>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-lg-10 col-sm-12">
            
                <div class="card mb-1 shadow">
                    <div class="card-header">
                        <h4 class="card-title">Group #</h4>
                        <p>Criteria for Judging!</p>
                        <ol>
                            <li>Content <b class="text-danger">(40%)</b></li>
                            <ul>
                                <li>Accuracy: Is the information presented accurate and well-researched? (10%)</li>
                                <li>Relevance: Is the content relevant to the assigned topic or subject? (10%)</li>
                                <li>Depth of Analysis: Does the report provide thorough analysis and critical thinking?
                                    (10%)</li>
                                <li>Originality: Are the ideas original and not just a repetition of known information?
                                    (10%)</li>
                            </ul>
                            <li>Organization <b class="text-danger">(20%)</b></li>
                            <ul>
                                <li>Structure: Is the report well-structured with a clear introduction, body, and
                                    conclusion? (10%)</li>
                                <li>Flow: Does the information flow logically from one section to the next? (10%)</li>
                            </ul>
                            <li>Presentation <b class="text-danger">(20%)</b></li>
                            <ul>
                                <li>Clarity: Is the report clear and easy to understand? (10%)</li>
                                <li>Visual Aids: Are visual aids (slides, charts, graphs, etc.) used effectively? (10%)
                                </li>
                            </ul>
                            <li>Delivery <b class="text-danger">(20%)</b></li>
                            <ul>
                                <li>Confidence: Does the presenter speak confidently and clearly? (10%)</li>
                                <li>Engagement: Does the presenter engage the audience and maintain their interest?
                                    (10%)</li>
                            </ul>
                        </ol>
                    </div>

                    <div class="card-body" hx-swap-oob="innerHTML:#response">
                        <div class="table-responsive">
                            <?php
                                $participants = (new Rating())->getActiveParticipantsInAGroup();
                            ?>

                            <form id="checked-contacts" hx-post="submit-rating" hx-swap="innerHTML">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Content</th>
                                            <th>Organization</th>
                                            <th>Presentation</th>
                                            <th>Delivery</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($participants as $participant) { ?>
                                            <tr class="fs-6 text-uppercase">
                                                <td><?= $participant['fullname'] ?></td>
                                                <td>
                                                    <select class="form-select form-select-sm" required
                                                        name="ratings[<?= $participant['id'] ?>][content]"
                                                        <?= $participant['content'] != null ? 'disabled' : '' ?>>
                                                        <option value="<?= $participant['content'] ?>">
                                                            <?= $participant['content'] ?>
                                                        </option>
                                                        <?php for ($i = 40; $i >= 1; $i--) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm" required
                                                        name="ratings[<?= $participant['id'] ?>][organization]"
                                                        <?= $participant['organization'] != null ? 'disabled' : '' ?>>
                                                        <option value="<?= $participant['organization'] ?>">
                                                            <?= $participant['organization'] ?>
                                                        </option>
                                                        <?php for ($i = 20; $i >= 1; $i--) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm" required
                                                        name="ratings[<?= $participant['id'] ?>][presentation]"
                                                        <?= $participant['presentation'] != null ? 'disabled' : '' ?>>
                                                        <option value="<?= $participant['presentation'] ?>">
                                                            <?= $participant['presentation'] ?>
                                                        </option>
                                                        <?php for ($i = 20; $i >= 1; $i--) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm" required
                                                        name="ratings[<?= $participant['id'] ?>][delivery]"
                                                        <?= $participant['delivery'] != null ? 'disabled' : '' ?>>
                                                        <option value="<?= $participant['delivery'] ?>">
                                                            <?= $participant['delivery'] ?>
                                                        </option>
                                                        <?php for ($i = 20; $i >= 1; $i--) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <button class="btn btn-dark btn-sm" type="submit">Submit Rating</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-1">
            </div>
        </div>
    </div>
    <section class="mb-5 pb-5 mt-2 py-2 text-center">
        <h6>
            <i class="bi bi-arrow-left"></i>Slide left or right<i class="bi bi-arrow-right"></i>
        </h6>
    </section>
</body>

</html>