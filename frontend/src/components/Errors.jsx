import PropTypes from "prop-types";

export default function Errors({errors}) {
  return (
    <>
      {errors.length === 0 ? null : (
        <div className="alert alert-danger p-2" role="alert">
          <ul>
            {errors.map((error, index) => (
              <li key={index}>{error}</li>
            ))}
          </ul>
        </div>
      )}
    </>
  );
}

Errors.propTypes = {
  errors: PropTypes.array.isRequired
}