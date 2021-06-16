<?php

namespace Drupal\salesforce\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFieldsWithMetadata;
use Drupal\salesforce\SelectQueryInterface;
use Drupal\salesforce\SelectQueryResult;

/**
 * Adds structured metadata to RowsOfFieldsWithMetadata.
 */
class QueryResult extends RowsOfFieldsWithMetadata {

  /**
   * Size of query result.
   *
   * @var int
   */
  protected $size;

  /**
   * Total records returned by query.
   *
   * @var int
   */
  protected $total;

  /**
   * The query.
   *
   * @var \Drupal\salesforce\SelectQueryInterface
   */
  protected $query;

  /**
   * QueryResult constructor.
   *
   * @param \Drupal\salesforce\SelectQueryInterface $query
   *   SOQL query.
   * @param \Drupal\salesforce\SelectQueryResult $queryResult
   *   SOQL result.
   */
  public function __construct(SelectQueryInterface $query, SelectQueryResult $queryResult) {
    $data = [];
    foreach ($queryResult->records() as $id => $record) {
      $data[$id] = $record->fields();
    }
    parent::__construct($data);
    $this->size = count($queryResult->records());
    $this->total = $queryResult->size();
    $this->query = $query;
  }

  /**
   * Getter for query size (total number of records returned).
   *
   * @return int
   *   The size.
   */
  public function getSize() {
    return $this->size;
  }

  /**
   * Getter for query total (total number of records available).
   *
   * @return mixed
   *   The total.
   */
  public function getTotal() {
    return $this->total;
  }

  /**
   * Getter for query.
   *
   * @return \Drupal\salesforce\SelectQuery
   *   The query.
   */
  public function getQuery() {
    return $this->query;
  }

  /**
   * Get a prettified query.
   *
   * @return string
   *   Strip '+' escaping from the query.
   */
  public function getPrettyQuery() {
    return str_replace('+', ' ', (string) $this->query);
  }

}
