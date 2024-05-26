$(document).ready(function () {
  const button = document.getElementById("mixedTableShow");
  const titleSpan = document.getElementById("mixedTableShow-title");

  let isClicked = false;

  button.addEventListener("click", function () {
    // button.classList.remove("blue-button");
    isClicked = !isClicked;
    if (isClicked) {
      titleSpan.style.color = "Blue";
      titleSpan.style.fontSize = "initial";

    } else {
      titleSpan.style.color = "initial";
    }
  });

  const cells = document.querySelectorAll(".Remarkstd");
  cells.forEach(function (cell) {
    cell.addEventListener("click", function () {
      this.classList.toggle("expanded");
    });
  });


  const tables = document.querySelectorAll(".resizable-table");

  tables.forEach((table) => {
    let columnWidths = [];
    let rowHeights = [];

    // Get stored column widths and row heights from local storage
    if (localStorage.getItem(`${table.id}_columnWidths`)) {
      columnWidths = JSON.parse(
        localStorage.getItem(`${table.id}_columnWidths`)
      );
      setColumnWidths();
    }

    if (localStorage.getItem(`${table.id}_rowHeights`)) {
      rowHeights = JSON.parse(localStorage.getItem(`${table.id}_rowHeights`));
      setRowHeights();
    }

    // Attach event listeners for resizing columns and rows with drag and slide
    table.querySelectorAll("th").forEach((header, index) => {
      header.addEventListener("mousedown", (event) => {
        const startX = event.pageX;
        const startWidth = header.offsetWidth;

        function handleMouseMove(event) {
          const width = startWidth + (event.pageX - startX);
          columnWidths[index] = width;
          setColumnWidths();
        }

        function handleMouseUp() {
          document.removeEventListener("mousemove", handleMouseMove);
          document.removeEventListener("mouseup", handleMouseUp);
        }

        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
      });
    });

    table.querySelectorAll("tr").forEach((row, index) => {
      row.addEventListener("mousedown", (event) => {
        const startY = event.pageY;
        const startHeight = row.offsetHeight;

        function handleMouseMove(event) {
          const height = startHeight + (event.pageY - startY);
          rowHeights[index] = height;
          setRowHeights();
        }

        function handleMouseUp() {
          document.removeEventListener("mousemove", handleMouseMove);
          document.removeEventListener("mouseup", handleMouseUp);
        }

        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
      });
    });

    // Set column widths and row heights based on stored values
    function setColumnWidths() {
      table.querySelectorAll("tr").forEach((row, rowIndex) => {
        row.querySelectorAll("th, td").forEach((cell, cellIndex) => {
          if (cell.tagName === "TH") {
            cell.style.width = `${columnWidths[cellIndex]}px`;
          } else {
            const headerWidth = columnWidths[cellIndex];
            if (headerWidth) {
              cell.style.width = `${headerWidth}px`;
            }
          }
        });
      });

      // Store updated column widths in local storage
      localStorage.setItem(
        `${table.id}_columnWidths`,
        JSON.stringify(columnWidths)
      );
    }

    function setRowHeights() {
      table.querySelectorAll("tr").forEach((row, rowIndex) => {
        const height = rowHeights[rowIndex];
        if (height) {
          row.style.height = `${height}px`;
        }
      });

      // Store updated row heights in local storage
      localStorage.setItem(
        `${table.id}_rowHeights`,
        JSON.stringify(rowHeights)
      );
    }
  });
});

