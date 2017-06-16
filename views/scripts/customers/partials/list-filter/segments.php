<?php
/** @var \CustomerManagementFrameworkBundle\CustomerView\CustomerViewInterface $cv */
$cv = $this->customerView;
?>

<?php if (isset($this->segmentGroups)): ?>

    <fieldset>
        <legend>
            <?= $cv->translate('Segments') ?>
        </legend>

        <div class="row">

            <?php
            /** @var \Pimcore\Model\Object\CustomerSegmentGroup $segmentGroup */
            foreach ($this->segmentGroups as $segmentGroup): ?>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="form-filter-segment-<?= $segmentGroup->getId() ?>"><?= $segmentGroup->getName() ?></label>
                        <select
                            id="form-filter-segment-<?= $segmentGroup->getId() ?>"
                            name="filter[segments][<?= $segmentGroup->getId() ?>][]"
                            class="form-control plugin-select2"
                            multiple="multiple"
                            data-placeholder="<?= $segmentGroup->getName() ?>"
                            data-select2-options='<?= json_encode(['allowClear' => false]) ?>'>

                            <?php
                            $segments = \CustomerManagementFrameworkBundle\Factory::getInstance()
                                ->getSegmentManager()
                                ->getSegmentsFromSegmentGroup($segmentGroup);

                            /** @var \CustomerManagementFrameworkBundle\Model\CustomerSegmentInterface|\Pimcore\Model\Element\ElementInterface $segment */
                            foreach ($segments as $segment): ?>

                                <option value="<?= $segment->getId() ?>" <?= $this->formFilterSelectedState($segmentGroup->getId(), $segment->getId(), true, ['filters', 'segments']) ?>>
                                    <?= $segment->getName() ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </fieldset>
<?php endif; ?>
